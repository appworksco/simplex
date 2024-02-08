<?php

class CTSFacade extends DBConnection
{

    public function fetchTickets()
    {
        $sql = $this->connect()->prepare("SELECT * FROM cts");
        $sql->execute();
        return $sql;
    }

    public function fetchIssueById($issueId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM issues WHERE id = ?");
        $sql->execute([$issueId]);
        return $sql;
    }

    public function addTicket($ticketNo, $ticketDate, $timeRequested, $requestedBy, $department, $issue, $description, $severity)
    {
        $sql = $this->connect()->prepare("INSERT INTO cts(ticket_no, ticket_date, time_requested, requested_by, department, issue, description, severity) VALUES (?,?,?,?,?,?,?,?)");
        $sql->execute([$ticketNo, $ticketDate, $timeRequested, $requestedBy, $department, $issue, $description, $severity]);
        return $sql;
    }

    public function updateIssue($issue, $issueId)
    {
        $sql = $this->connect()->prepare("UPDATE issues SET issue = '$issue' WHERE id = '$issueId'");
        $sql->execute();
        return $sql;
    }

    public function verifyIssue($issue)
    {
        $sql = $this->connect()->prepare("SELECT issue FROM issues WHERE issue = ?");
        $sql->execute([$issue]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteIssue($issueId)
    {
        $sql = $this->connect()->prepare("DELETE FROM issues WHERE id = $issueId");
        $sql->execute();
        return $sql;
    }
}
