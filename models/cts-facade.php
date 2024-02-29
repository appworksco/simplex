<?php

class CTSFacade extends DBConnection
{

    public function fetchTickets() {
        $sql = $this->connect()->prepare("SELECT * FROM cts ORDER BY created_at DESC");
        $sql->execute();
        return $sql;
    }

    public function fetchTicketById($ctsId) {
        $sql = $this->connect()->prepare("SELECT * FROM cts WHERE id = ?");
        $sql->execute([$ctsId]);
        return $sql;
    }

    public function addTicket($ticketNo, $created_at, $requestedBy, $department, $status, $issue, $description, $severity, $file_path) {
        $sql = $this->connect()->prepare("INSERT INTO cts(ticket_no, created_at, requested_by, department, status, issue, description, severity, image) VALUES (?,?,?,?,?,?,?,?,?)");
        $sql->execute([$ticketNo, $created_at, $requestedBy, $department, $status, $issue, $description, $severity, $file_path,]); 
        return $sql;
    }

    public function updateTicket($ctsId, $status, $assistedBy, $assistorsRemark, $timeResolved) {
        $sql = $this->connect()->prepare("UPDATE cts SET status = ?, assisted_by = ?, assistors_remark = ?, time_resolved = ? WHERE id = ?");
        $sql->execute([$status, $assistedBy, $assistorsRemark, $timeResolved, $ctsId]);
        return $sql;
    }

    public function deleteTicket($ctsId) {
        $sql = $this->connect()->prepare("DELETE FROM cts WHERE id = $ctsId");
        $sql->execute();
        return $sql;
    }

    public function fetchChatMessages($ctsId) {
        $sql = $this->connect()->prepare("SELECT * FROM cts_chat WHERE cts_id = ? ORDER BY created_at ASC");
        $sql->execute([$ctsId]);
        return $sql;
    }

    public function addChatMessage($userId, $ctsId, $message) {
        $sql = $this->connect()->prepare("INSERT INTO cts_chat (user_id, cts_id, message) VALUES (?, ?, ?)");
        $sql->execute([$userId, $ctsId, $message]);
        return $sql;
    }
}
