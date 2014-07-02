<?php
interface Chessman{


    public function check_run();

    public function __construct($game, $new_position, $chessman);
}