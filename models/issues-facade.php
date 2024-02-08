<?php

class IssuesFacade extends DBConnection
{

    public function fetchIssues()
    {
        $sql = $this->connect()->prepare("SELECT * FROM issues ORDER BY issue");
        $sql->execute();
        return $sql;
    }

    public function fetchIssueById($issueId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM issues WHERE id = ?");
        $sql->execute([$issueId]);
        return $sql;
    }

    public function addIssue($issue)
    {
        $sql = $this->connect()->prepare("INSERT INTO issues(issue) VALUES (?)");
        $sql->execute([$issue]);
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
