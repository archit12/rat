<?php

class AttainmentHallController extends BaseController implements ControllerLocationInterface
{
    public function __construct(SkillInterface $skill) {
        $this->skill = $skill;
    }

    public function index() {
        AttainmentHallController::changeLocation();
        Rat_Users::turnFree(['sender' => Session::get('uid'), 'receiver' => Session::get('rec_id', 0)]);
        $timer = AttainmentHallController::isTimerShown();
        $contents = AttainmentHallController::showBookContents();
        $skills = Rat_User_Skill::getAll(Session::get('uid'));
        return View::make('AttainmentHall.attainmentHall')
        ->with(array('skills' => $skills,
         'contents' => $contents, 'timer' => $timer));
    }

    public static function showBookContents() {
        return Rat_User_Skill::getBookContents(Session::get('uid'));
    }

    public static function isTimerShown() {
        $timeWhenEligible = Rat_User_Skill::getTime(Session::get('uid'));
        if (array_key_exists(0, $timeWhenEligible)) {
            $timeWhenEligible = $timeWhenEligible[0]->time;
        }
        date_default_timezone_set('Asia/Kolkata');
        $timeWhenEligible = new DateTime($timeWhenEligible);
        $current_time = new DateTime();
        $timer = $timeWhenEligible->getTimeStamp() - $current_time->getTimeStamp();
        return $timer;
    }

    public function learnSkill() {
        //sent by ajax post from AttainmentHall View
        $skill_id = Input::get('skill');
        $this->skill->learnSkill($skill_id);
    }

    public function checkSkill() {
        // $current = Rat_User_Skill::getCurrentLevel(Session::get('uid'), 5);
        // if (array_key_exists(0, $current)) {
        //     $current = $current[0]->level;
        // }
        // print_r($current);
        return json_encode(array('a' => 'Archit', 'b' => 1));
    }

    public function check() {
        return View::make('check.check');
        //echo AttainmentHallController::isTimerShown();
        //echo Skill::checkTime(3,3);
        //Rat_User_Skill::setTime(7, 5);
        //Skill::checkTime(5, 1);

        /*date_default_timezone_set('Asia/Kolkata');
        $current_time = new DateTime();
        $current_time->format('H:i:s');
        $learnt_time = Rat_User_Skill::getTime(7, 5);
        if (array_key_exists(0, $learnt_time)) {
            $learnt_time = $learnt_time[0]->time;
        }
                    $learnt_time = '00:00:00';
                    $old_time = new DateTime($learnt_time);
                    $old_time->format('H:i:s');
                    print_r($old_time);
                    echo "<br>";
                    echo "old time->".$old_time->getTimeStamp();
                    echo "<br>";
                    echo $current_time->getTimeStamp();
                    echo "<br>";
                    echo $current_time->getTimeStamp() - $old_time->getTimeStamp();
        $total_time = Rat_User_Skill::getTotalTime(5);
        if (array_key_exists(0, $total_time)) {
            $total_time = intval($total_time[0]->time);
        }
                    echo "<br>".$total_time*1000;
                    die();
        $total_time *= 1000;
        $difference = $current_time->getTimeStamp() - $old_time->getTimeStamp();
        if ($total_time > $difference) {
            echo "not yet";
        }
        else {
            echo "valid";
        }
        print_r($old_time);
        print_r( $current_time->getTimeStamp() - $old_time->getTimeStamp());
        print_r($current_time->diff($old_time));*/
    }

    public static function changeLocation() {
        Rat_Users::setLocation(Session::get('uid') ,1);
    }
}
?>