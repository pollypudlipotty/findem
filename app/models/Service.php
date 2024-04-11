<?php

namespace app\models;

use app\helpers\Helper;
use core\DatabaseHandler;
use DateTime;
use JetBrains\PhpStorm\NoReturn;

class Service
{
    private DatabaseHandler $dbConn;

    public function __construct()
    {
        $this->dbConn = new DatabaseHandler();
    }

    public function loadCategories(): bool|array
    {
        $this->dbConn->query("SELECT * FROM service_category");
        return $this->dbConn->resultSet();
    }

    public function loadAvailableAppointments(int $limit = null): array
    {
        $sql = "SELECT service_category.category_name, appointment.appointment_id, appointment.appointment_date,
                        appointment.appointment_time, appointment.appointment_duration,  appointment.appointment_fee,
                        service.service_district, service.service_address, service.service_housenumber, service.service_provider_id,
                        service.service_description, service.service_name, service_category.category_id
                                    FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id=service.service_id
                                        INNER JOIN service_category
                                            ON service_category.category_id=service.service_category_id
                                    WHERE appointment.status_id = 1
                                      AND (appointment.appointment_date > CURDATE()
                                            OR (appointment.appointment_date = CURDATE() 
		                                        AND appointment.appointment_time > TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR))))
                                    ORDER BY appointment.appointment_date ASC";

        if ($limit !== null) {
            $sql .= " LIMIT $limit";
        }

        $this->dbConn->query($sql);

        $appointments = $this->dbConn->resultSet();

        return $this->calculateAppointmentTimeInArray($appointments);
    }

    public function loadAvailableAppointmentsForCategory(int $categoryId, int $limit = null): array
    {
        $sql = "SELECT service_category.category_name, appointment.appointment_id, appointment.appointment_date,
                        appointment.appointment_time, appointment.appointment_duration,  appointment.appointment_fee,
                        service.service_district, service.service_address, service.service_housenumber, service.service_provider_id,
                        service.service_description, service.service_name, service_category.category_id
                                    FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id=service.service_id
                                        INNER JOIN service_category
                                            ON service_category.category_id=service.service_category_id
                                    WHERE appointment.status_id=1 AND service_category.category_id = :categoryId
                                    AND (appointment.appointment_date > CURDATE()
                                            OR (appointment.appointment_date = CURDATE() 
		                                        AND appointment.appointment_time > TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR))))
                                    ORDER BY appointment.appointment_date ASC";

        if ($limit !== null) {
            $sql .= " LIMIT $limit";
        }

        $this->dbConn->query($sql);

        $this->dbConn->bind(':categoryId', $categoryId);

        $appointments = $this->dbConn->resultSet();

        return $this->calculateAppointmentTimeInArray($appointments);
    }

    public function getServiceData(): bool|array
    {
        $this->dbConn->query("SELECT * FROM service
                                    WHERE service_provider_id = :user_id");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        return $this->dbConn->single();
    }

    public function calculateAppointmentTimeInArray(array $appointments): array
    {
        if (empty($appointments)) {
            return $appointments;
        }

        foreach ($appointments as &$appointment) {
            $dateTime = DateTime::createFromFormat('H:i:s', $appointment['appointment_time']);

            $durationHours = floor($appointment['appointment_duration']);
            $durationMinutes = ($appointment['appointment_duration'] - $durationHours) * 60;

            $dateTime->modify("+$durationHours hours");
            $dateTime->modify("+$durationMinutes minutes");

            $resultTime = $dateTime->format('H:i:s');
            $appointmentTime = $appointment['appointment_date'] . ' ' . $appointment['appointment_time'] . '-' . $resultTime;

            $appointment['appointmentTime'] = $appointmentTime;

            unset($appointment['appointment_date']);
            unset($appointment['appointment_time']);
            unset($appointment['appointment_duration']);
        }

        unset($appointment);

        return $appointments;
    }

    public function getFreeAppointmentsOfProvider(): bool|array
    {
        $this->dbConn->query("SELECT  appointment.appointment_id, appointment.appointment_date,
                                            appointment.appointment_time, appointment.appointment_duration,
                                            appointment.appointment_fee
                                        FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id = service.service_id
                                        WHERE service.service_provider_id = :provider_id
                                        AND appointment.status_id = 1
                                          AND (appointment.appointment_date > CURDATE()
	                                            OR (appointment.appointment_date = CURDATE()
     	                                            AND appointment.appointment_time > TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR)))) ");

        $this->dbConn->bind(':provider_id', $_SESSION['user']);
        $freeAppointments = $this->dbConn->resultSet();
        return $this->calculateAppointmentTimeInArray($freeAppointments);
    }

    public function deleteAppointment(int $appointmentId): bool
    {
        $this->dbConn->query("DELETE FROM appointment
                                        WHERE appointment_id = :appointment_id");

        $this->dbConn->bind(':appointment_id', $appointmentId);
        return $this->dbConn->execute();
    }

    public function getUpcomingReservationsOfProvider(): array
    {
        $this->dbConn->query("SELECT  appointment.appointment_id, appointment.appointment_date,
                                            appointment.appointment_time, appointment.appointment_duration,
                                            appointment.appointment_fee, user.first_name, user.last_name, user.email_address
                                        FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id = service.service_id
                                        INNER JOIN reservation
                                            ON reservation.appointment_id = appointment.appointment_id 
                                        INNER JOIN user
                                            ON reservation.user_id = user.user_id
                                        WHERE appointment.service_id = (SELECT service_id FROM service WHERE service_provider_id = :user_id)
                                        AND appointment.status_id 
                                          AND (appointment.appointment_date > CURDATE()
	                                            OR (appointment.appointment_date = CURDATE()
     	                                            AND appointment.appointment_time > TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR))))");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        $upcomingAppointments = $this->dbConn->resultSet();
        return $this->calculateAppointmentTimeInArray($upcomingAppointments);
    }

    public function getPastReservationsOfProvider(): array
    {
        $this->dbConn->query("SELECT  appointment.appointment_id, appointment.appointment_date,
                                            appointment.appointment_time, appointment.appointment_duration,
                                            appointment.appointment_fee, user.first_name, user.last_name, user.email_address
                                        FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id = service.service_id
                                        INNER JOIN reservation
                                            ON reservation.appointment_id = appointment.appointment_id 
                                        INNER JOIN user
                                            ON reservation.user_id = user.user_id
                                        WHERE appointment.service_id = (SELECT service_id FROM service WHERE service_provider_id = :user_id)
                                        AND appointment.status_id 
                                          AND (appointment.appointment_date < CURDATE()
	                                            OR (appointment.appointment_date = CURDATE()
     	                                            AND appointment.appointment_time < TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR))))");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        $pastAppointments = $this->dbConn->resultSet();
        return $this->calculateAppointmentTimeInArray($pastAppointments);
    }

    public function getReservationsOfUser(): array
    {
         $this->dbConn->query("SELECT appointment.appointment_id, appointment.appointment_date, appointment.appointment_time,
                                            appointment.appointment_duration, appointment.appointment_fee, service.service_name,
                                            service.service_district, service.service_address, service.service_housenumber,
                                            service.service_description, service_category.category_name, user.email_address
	                                    FROM appointment
		                                INNER JOIN service 
			                                ON appointment.service_id = service.service_id
                                        INNER JOIN reservation
                                            ON reservation.appointment_id = appointment.appointment_id
                                        INNER JOIN user
                                            ON service.service_provider_id = user.user_id
                                        INNER JOIN service_category
                                            ON service.service_category_id = service_category.category_id
                                        WHERE reservation.user_id = :user_id
                                        AND (appointment.appointment_date > CURDATE()
                                             OR (appointment.appointment_date = CURDATE() 
                                                AND appointment.appointment_time > TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR))))");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        $reservations = $this->dbConn->resultSet();
        return $this->calculateAppointmentTimeInArray($reservations);
    }

    public function getPastReservationsOfUser(): array
    {
        $this->dbConn->query("SELECT appointment.appointment_id, appointment.appointment_date, appointment.appointment_time,
                                            appointment.appointment_duration, appointment.appointment_fee, service.service_name,
                                                 service_category.category_name, user.email_address
	                                    FROM appointment
		                                INNER JOIN service 
			                                ON appointment.service_id = service.service_id
                                        INNER JOIN reservation
                                            ON reservation.appointment_id = appointment.appointment_id
                                        INNER JOIN user
                                            ON service.service_provider_id = user.user_id
                                        INNER JOIN service_category
                                            ON service.service_category_id = service_category.category_id
                                        WHERE reservation.user_id = :user_id
                                        AND (appointment.appointment_date < CURDATE()
                                             OR (appointment.appointment_date = CURDATE() 
                                                AND appointment.appointment_time < TIME(DATE_ADD(NOW(), INTERVAL 2 HOUR))))");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        $pastReservations = $this->dbConn->resultSet();
        return $this->calculateAppointmentTimeInArray($pastReservations);
    }

    #[NoReturn] public function addAppointment(array $appointmentData): void
    {
        $this->dbConn->query("SELECT service_id FROM service WHERE service_provider_id = :user_id");
        $this->dbConn->bind(':user_id', $_SESSION['user']);
        $result = $this->dbConn->single();

        $this->dbConn->query("INSERT INTO appointment (service_id, status_id, appointment_date, appointment_time, appointment_duration, appointment_fee)
                                    VALUES (:service_id, :status_id, :appointment_date, :appointment_time, :appointment_duration, :appointment_fee)");

        $this->dbConn->bind(':service_id', $result['service_id']);
        $this->dbConn->bind(':status_id', 1);
        $this->dbConn->bind(':appointment_date', $appointmentData['date']);
        $this->dbConn->bind(':appointment_time', $appointmentData['start_time']);
        $this->dbConn->bind(':appointment_duration', $appointmentData['duration']);
        $this->dbConn->bind(':appointment_fee', $appointmentData['fee']);

        if ($this->dbConn->execute()) {
            Helper::redirectWithMessage(MESSAGES['appointmentAdded'], 'service_profile');
        }

        Helper::redirectWithMessage(MESSAGES['error'], 'new_appointment');
    }

    public function reserveAppointment(int $appointmentId, int $userId): bool
    {
        $this->dbConn->query("INSERT INTO reservation (appointment_id, user_id) VALUES (:appointment_id, :user_id)");

        $this->dbConn->bind(':appointment_id', $appointmentId);
        $this->dbConn->bind(':user_id', $userId);

        if ($this->dbConn->execute()) {
            $this->dbConn->query("UPDATE appointment SET status_id = 2 WHERE appointment_id = :appointment_id");

            $this->dbConn->bind(':appointment_id', $appointmentId);

            if ($this->dbConn->execute()) {
                return true;
            }
        }

        return false;
    }
}
