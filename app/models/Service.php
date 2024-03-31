<?php

namespace app\models;

use core\DatabaseHandler;
use DateTime;
use PDO;

class Service
{
    private $dbConn;

    public function __construct()
    {
        $this->dbConn = new DatabaseHandler();
    }

    public function loadCategories()
    {
        $this->dbConn->query("SELECT * FROM service_category");
        return $this->dbConn->resultSet();
    }

    public function loadAvailableAppointments()
    {
        $this->dbConn->query("SELECT service_category.category_name,  appointment.appointment_date, appointment.appointment_time,
                                            appointment.appointment_duration, service.service_district, service.service_description, service_category.category_id
                                    FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id=service.service_id
                                        INNER JOIN service_category
                                            ON service_category.category_id=service.service_category_id
                                    WHERE appointment.status_id=1
                                    ORDER BY appointment.appointment_date ASC
                                    LIMIT 3");

        $appointments = $this->dbConn->resultSet();

        foreach ($appointments as &$appointment) {
            $dateTime = DateTime::createFromFormat('H:i:s', $appointment['appointment_time']);
            $dateTime->modify("+{$appointment['appointment_duration']} hours");
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

    public function loadAvailableAppointmentsForCategory(int $categoryId)
    {
        $this->dbConn->query("SELECT service_category.category_name,  appointment.appointment_date, appointment.appointment_time,
                                            appointment.appointment_duration, service.service_district, service.service_description, service_category.category_id
                                    FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id=service.service_id
                                        INNER JOIN service_category
                                            ON service_category.category_id=service.service_category_id
                                    WHERE appointment.status_id=1 AND service_category.category_id = :categoryId
                                    ORDER BY appointment.appointment_date ASC
                                    LIMIT 3");

        $this->dbConn->bind(':categoryId', $categoryId);

        $appointments = $this->dbConn->resultSet();

        foreach ($appointments as &$appointment) {
            $dateTime = DateTime::createFromFormat('H:i:s', $appointment['appointment_time']);
            $dateTime->modify("+{$appointment['appointment_duration']} hours");
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

    public function getServiceData(): bool|array
    {
        $this->dbConn->query("SELECT * FROM service
                                    WHERE service_provider_id = :user_id");

        $this->dbConn->bind(':user_id', $_SESSION['user']);
        return $this->dbConn->single();
    }
}
