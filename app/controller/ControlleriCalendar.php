<?php

require_once '../model/ModelRdv.php';
require_once '../model/ModelCreneau.php';

class ControlleriCalendar {

    public static function innovation1() {
        include 'config.php';
        $vue = $root . '/app/view/innovation/innovation_1.php';
        require ($vue);
    }

    public static function telecharger() {
        $results = ModelRdv::getRdvEtudiant();

        if ($_GET['download'] == '1') {
            $liste_creneaux = [];
            foreach ($results as $element) {
                $liste_creneaux[] = $element->getCreneau();
            }

            $liste_icalendar = [];

            foreach ($liste_creneaux as $creneau) {
                date_default_timezone_set('UTC');
                $dtstamp = date('Ymd\THis\Z');
                $creneauicalendar = "BEGIN:VEVENT\r\n"
                        . "UID:" . self::convertisseuriCalendar($creneau) . "@utt.fr\r\n"
                        . "DTSTAMP:" . $dtstamp . "\r\n"
                        . "DTSTART:" . self::convertisseuriCalendar($creneau) . "\r\n"
                        . "DTEND:" . self::convertisseuriCalendar(self::finCreneau($creneau)) . "\r\n"
                        . "SUMMARY: Soutenance Projet\r\n"
                        . "END:VEVENT\r\n";
                array_push($liste_icalendar, $creneauicalendar);
            }

            $contenu = "BEGIN:VCALENDAR\r\n"
                    . "VERSION:2.0\r\n"
                    . "PRODID:-//UTT//LO07//FR\r\n";

            foreach ($liste_icalendar as $icalendar) {
                $contenu .= $icalendar;
            }
            $contenu .= "END:VCALENDAR";

            if (ob_get_length()) {
                ob_end_clean();
            }

            header('Content-Type: text/calendar; charset=utf-8');
            header('Content-Disposition: attachment; filename="iCalendar.ics"');
            echo $contenu;
            exit;
        }
    }

    public static function telechargerExam() {
        $results = ModelCreneau::getCreneauOnlyExaminateur();

        if ($_GET['download'] == '1') {
            $liste_creneaux = [];
            foreach ($results as $element) {
                $liste_creneaux[] = $element->getCreneau();
            }

            $liste_icalendar = [];

            foreach ($liste_creneaux as $creneau) {
                date_default_timezone_set('UTC');
                $dtstamp = date('Ymd\THis\Z');
                $creneauicalendar = "BEGIN:VEVENT\r\n"
                        . "UID:" . self::convertisseuriCalendar($creneau) . "@utt.fr\r\n"
                        . "DTSTAMP:" . $dtstamp . "\r\n"
                        . "DTSTART:" . self::convertisseuriCalendar($creneau) . "\r\n"
                        . "DTEND:" . self::convertisseuriCalendar(self::finCreneau($creneau)) . "\r\n"
                        . "SUMMARY: Soutenance Projet\r\n"
                        . "END:VEVENT\r\n";
                array_push($liste_icalendar, $creneauicalendar);
            }

            $contenu = "BEGIN:VCALENDAR\r\n"
                    . "VERSION:2.0\r\n"
                    . "PRODID:-//UTT//LO07//FR\r\n";

            foreach ($liste_icalendar as $icalendar) {
                $contenu .= $icalendar;
            }
            $contenu .= "END:VCALENDAR";

            if (ob_get_length()) {
                ob_end_clean();
            }

            header('Content-Type: text/calendar; charset=utf-8');
            header('Content-Disposition: attachment; filename="iCalendar.ics"');
            echo $contenu;
            exit;
        }
    }

//Outils pour gérer les créneaux du format iCalendar
    public static function convertisseuriCalendar($creneau) {
        $convertion = new DateTime($creneau);
        return $convertion->format('Ymd\THis');
    }

    public static function finCreneau($creneau) {
        $post_creneau = new DateTime($creneau);
        $post_creneau->modify('+1 hour');
        return $post_creneau->format('Y-m-d H:i:s');
    }
}
?>


