<?php

class ProjectTypeFacade extends DBConnection
{

    public function fetchProjectType()
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_type");
        $sql->execute();
        return $sql;
    }

    public function fetchProjectTypeById($projectTypeId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_type WHERE id = '$projectTypeId'");
        $sql->execute();
        return $sql;
    }

    public function verifyProjectTypeCode($projectTypeCode)
    {
        $sql = $this->connect()->prepare("SELECT * FROM bd_project_type WHERE project_type_code = ?");
        $sql->execute([$projectTypeCode]);
        $count = $sql->rowCount();
        return $count;
    }

    public function addProjectType($projectTypeCode, $projectDescription, $projectDetails)
    {
        $sql = $this->connect()->prepare("INSERT INTO bd_project_type(project_type_code, project_description, project_details) VALUES (?, ?, ?)");
        $sql->execute([$projectTypeCode, $projectDescription, $projectDetails]);
        return $sql;
    }

    public function updateProjectType($projectTypeCode, $projectDescription, $projectDetails, $projectTypeId)
    {
        $sql = $this->connect()->prepare("UPDATE bd_project_type SET project_type_code = '$projectTypeCode', project_description = '$projectDescription', project_details = '$projectDetails' WHERE id = '$projectTypeId'");
        $sql->execute();
        return $sql;
    }

    public function verifyLGU($LGUCode, $LGUName)
    {
        $sql = $this->connect()->prepare("SELECT lgu_code, lgu_name FROM bd_lgu WHERE lgu_code = ? AND lgu_name = ?");
        $sql->execute([$LGUCode, $LGUName]);
        $count = $sql->rowCount();
        return $count;
    }

    public function deleteProjectType($projectTypeId)
    {
        $sql = $this->connect()->prepare("DELETE FROM bd_project_type WHERE id = $projectTypeId");
        $sql->execute();
        return $sql;
    }

    public function getProjectSeries()
    {
        $sql = $this->connect()->prepare("SELECT series FROM bd_project_series ORDER BY series DESC LIMIT 1 ");
        $sql->execute();
        return $sql;
    }

    public function updateProjectSeries()
    {
        $sql = $this->connect()->prepare("UPDATE bd_project_series SET series = series + 1");
        $sql->execute();
        return $sql;
    }
}
