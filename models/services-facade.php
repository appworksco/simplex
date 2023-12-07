<?php

class ServicesFacade extends DBConnection {

    public function fetchServices() {
        $sql = $this->connect()->prepare("SELECT * FROM services ORDER BY service_name");
        $sql->execute();
        return $sql;
    }

    public function fetchServiceByCode($serviceCode) {
        $sql = $this->connect()->prepare("SELECT service_name FROM services WHERE service_code = ?");
        $sql->execute([$serviceCode]);
        return $sql;
    }

    public function fetchServiceById($serviceId) {
        $sql = $this->connect()->prepare("SELECT * FROM services WHERE id = ?");
        $sql->execute([$serviceId]);
        return $sql;
    }

    public function addService($serviceName, $serviceCode) {
        $sql = $this->connect()->prepare("INSERT INTO services(service_name, service_code) VALUES (?, ?)");
        $sql->execute([$serviceName, $serviceCode]);
        return $sql;
    }

    public function updateService($serviceName, $serviceCode, $serviceId) {
        $sql = $this->connect()->prepare("UPDATE services SET service_name = '$serviceName', service_code = '$serviceCode' WHERE id = '$serviceId'");
        $sql->execute();
        return $sql;
    }

    public function verifyServiceCode($serviceCode) {
        $sql = $this->connect()->prepare("SELECT service_code FROM services WHERE service_code = ?");
        $sql->execute([$serviceCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteService($serviceId)  {
        $sql = $this->connect()->prepare("DELETE FROM services WHERE id = $serviceId");
        $sql->execute();
        return $sql;
    }

}

?> 