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
        $result = $this->dbConn->resultSet();
        return $result;
    }

    public function loadAvailableAppointments()
    {
        $this->dbConn->query("SELECT service.service_name, service_category.category_name,
                                            appointment.appointment_date, appointment.appointment_time,
                                            appointment.appointment_duration, service.service_district, service.service_address,
                                            service.service_description
                                    FROM appointment
                                        INNER JOIN service
                                            ON appointment.service_id=service.service_id
                                        INNER JOIN service_category
                                            ON service_category.category_id=service.service_category_id
                                    WHERE appointment.status_id=1");

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
}