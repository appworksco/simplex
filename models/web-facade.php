<?php

class WebFacade extends DBConnection
{

    // Home Carousel ----------------------------------
    public function fetchHomeCarousel()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_carousel ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addHomeCarousel($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_home_carousel (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchHomeCarouselById($homeCarouselId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_carousel WHERE id = ?");
        $sql->execute([$homeCarouselId]);
        return $sql;
    }

    public function deleteHomeCarousel($homeCarouselId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_home_carousel WHERE id = $homeCarouselId");
        $sql->execute();
        return $sql;
    }

    public function getHomeCarouselDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_carousel WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHomeCarousel($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_home_carousel SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Home What's New ----------------------------------
    public function fetchHomeWhatsnew()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_whatsnew ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addHomeWhatsnew($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_home_whatsnew (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchHomeWhatsnewById($homeWhatsnewId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_whatsnew WHERE id = ?");
        $sql->execute([$homeWhatsnewId]);
        return $sql;
    }

    public function deleteHomeWhatsnew($homeWhatsnewId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_home_whatsnew WHERE id = $homeWhatsnewId");
        $sql->execute();
        return $sql;
    }

    public function getHomeWhatsnewDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_whatsnew WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHomeWhatsnew($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_home_whatsnew SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Home Partners ----------------------------------
    public function fetchHomePartners()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_partners ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addHomePartners($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_home_partners (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchHomePartnersById($homePartnersId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_partners WHERE id = ?");
        $sql->execute([$homePartnersId]);
        return $sql;
    }

    public function deleteHomePartners($homePartnersId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_home_partners WHERE id = $homePartnersId");
        $sql->execute();
        return $sql;
    }

    public function getHomePartnersDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_home_partners WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHomePartners($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_home_partners SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }


    // Events Carousel ----------------------------------
    public function fetchEventsCarousel()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_carousel ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addEventsCarousel($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_events_carousel (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchEventsCarouselById($eventsCarouselId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_carousel WHERE id = ?");
        $sql->execute([$eventsCarouselId]);
        return $sql;
    }

    public function deleteEventsCarousel($eventsCarouselId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_events_carousel WHERE id = $eventsCarouselId");
        $sql->execute();
        return $sql;
    }

    public function getEventsCarouselDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_carousel WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEventsCarousel($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_events_carousel SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Events Upcoming ----------------------------------
    public function fetchEventsUpcoming()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_upcoming ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addEventsUpcoming($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_events_upcoming (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchEventsUpcomingById($eventsUpcomingId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_upcoming WHERE id = ?");
        $sql->execute([$eventsUpcomingId]);
        return $sql;
    }

    public function deleteEventsUpcoming($eventsUpcomingId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_events_upcoming WHERE id = $eventsUpcomingId");
        $sql->execute();
        return $sql;
    }

    public function getEventsUpcomingDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_upcoming WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEventsUpcoming($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_events_upcoming SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Events Pics ----------------------------------
    public function fetchEventsPics()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_pics ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addEventsPics($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_events_pics (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchEventsPicsById($eventsPicsId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_pics WHERE id = ?");
        $sql->execute([$eventsPicsId]);
        return $sql;
    }

    public function deleteEventsPics($eventsPicsId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_events_pics WHERE id = $eventsPicsId");
        $sql->execute();
        return $sql;
    }

    public function getEventsPicsDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_pics WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEventsPics($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_events_pics SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Events All Partners ----------------------------------
    public function fetchEventsAllpartners()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_allpartners ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addEventsAllpartners($name, $imagePath, $caption)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_events_allpartners (name, image, caption) VALUES (?, ?, ?)");
        $sql->execute([$name, $imagePath, $caption]);
    }

    public function fetchEventsAllpartnersById($eventsAllpartnersId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_allpartners WHERE id = ?");
        $sql->execute([$eventsAllpartnersId]);
        return $sql;
    }

    public function deleteEventsAllpartners($eventsAllpartnersId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_events_allpartners WHERE id = $eventsAllpartnersId");
        $sql->execute();
        return $sql;
    }

    public function getEventsAllpartnersDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_events_allpartners WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEventsAllpartners($name, $imagePath, $caption, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_events_allpartners SET name = ?, image = ?, caption = ? WHERE id = ?");
        $result = $sql->execute([$name, $imagePath, $caption, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // About ----------------------------------
    public function fetchAbout()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_about ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addAbout($mission, $vision, $descript, $text)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_about (mission, vision, descript, text) VALUES (?, ?, ?, ?)");
        $sql->execute([$mission, $vision, $descript, $text]);
    }

    public function fetchAboutById($aboutId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_about WHERE id = ?");
        $sql->execute([$aboutId]);
        return $sql;
    }

    public function deleteAbout($aboutId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_about WHERE id = $aboutId");
        $sql->execute();
        return $sql;
    }

    public function getAboutDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_about WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAbout($mission, $vision, $descript, $text, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_about SET mission = ?, vision = ?, descript = ?, text = ? WHERE id = ?");
        $result = $sql->execute([$mission, $vision, $descript, $text, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Career ----------------------------------
    public function fetchCareer()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_career ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addCareer($jobPosition, $jobDescription, $jobRequirement)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_career (job_position, job_description, job_requirement) VALUES (?, ?, ?)");
        $sql->execute([$jobPosition, $jobDescription, $jobRequirement]);
    }

    public function fetchCareerById($careerId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_career WHERE id = ?");
        $sql->execute([$careerId]);
        return $sql;
    }

    public function deleteCareer($careerId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_career WHERE id = $careerId");
        $sql->execute();
        return $sql;
    }

    public function getCareerDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_career WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateCareer($jobPosition, $jobDescription, $jobRequirement, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_career SET job_position = ?, job_description = ?, job_requirement = ? WHERE id = ?");
        $result = $sql->execute([$jobPosition, $jobDescription, $jobRequirement, $id]);

        if ($result) {
            return true; // Pagtagumpay ang pag-update
        } else {
            return false; // Hindi nagtagumpay ang pag-update
        }
    }

    // Kasuki ----------------------------------
    public function fetchKasuki()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_kasuki ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addKasuki($textTitle, $textBody, $imagePath1, $imagePath2)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_kasuki (text_title, text_body, image1, image2) VALUES (?, ?, ?, ?)");
        $sql->execute([$textTitle, $textBody, $imagePath1, $imagePath2]);
    }

    public function fetchKasukiById($kasukiId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_kasuki WHERE id = ?");
        $sql->execute([$kasukiId]);
        return $sql;
    }

    public function deleteKasuki($kasukiId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_kasuki WHERE id = $kasukiId");
        $sql->execute();
        return $sql;
    }

    public function getKasukiDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_kasuki WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateKasuki($textTitle, $textBody, $imagePath1, $imagePath2, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_kasuki SET text_title = ?, text_body = ?, image1 = ?, image2 = ? WHERE id = ?");
        $result = $sql->execute([$textTitle, $textBody, $imagePath1, $imagePath2, $id]);

        return $result;
    }

    // Contact ----------------------------------
    public function fetchContact()
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_contact ORDER BY id DESC");
        $sql->execute();
        return $sql;
    }

    public function addContact($email, $name, $message)
    {
        $sql = $this->connect()->prepare("INSERT INTO web_contact (email, name, message) VALUES (?, ?, ?)");
        $sql->execute([$email, $name, $message]);
    }

    public function fetchContactById($contactId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_contact WHERE id = ?");
        $sql->execute([$contactId]);
        return $sql;
    }

    public function deleteContact($contactId)
    {
        $sql = $this->connect()->prepare("DELETE FROM web_contact WHERE id = $contactId");
        $sql->execute();
        return $sql;
    }

    public function getContactDetails($id)
    {
        $sql = $this->connect()->prepare("SELECT * FROM web_contact WHERE id = ?");
        $sql->execute([$id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function updateContact($email, $name, $message, $id)
    {
        $sql = $this->connect()->prepare("UPDATE web_contact SET email = ?, name = ?, message = ? WHERE id = ?");
        $result = $sql->execute([$email, $name, $message, $id]);
    }
}
