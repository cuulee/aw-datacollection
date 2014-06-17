<?php if (!defined('ENVIRONMENT') && ENVIRONMENT == 'demo') exit('No direct script access allowed');

  $minutes_between_resets = 30;
  $control_file = 'reset.demo.last';
  $key_file = 'reset.demo.key';

  // Get date of last reset.
  $last = @unserialize(file_get_contents($control_file));
  
  // Is valid date.
  if (!$last || !($last instanceof DateTime)) {
    // Set counter for the first time.
    $last = new DateTime();
    file_put_contents($control_file, serialize($last));
  }
  
  // Calculate when the next reset should happen.
  $last->add(new DateInterval('PT' . $minutes_between_resets . 'M'));
  $interval = $last->diff(new DateTime());
  
  // Is the reset date still in the future?
  if ($interval->invert === 1) {
    $seconds = $interval->s + $interval->i * 60 + $interval->h * 60 * 60;
    define('RESET_SECONDS_LEFT', $seconds);
  }
  else {
    $demo_key = @file_get_contents($key_file);
    // Set reset time and Redirect.
    file_put_contents($control_file, serialize(new DateTime()));
    header('Location: http://192.168.99.10/work/aw-datacollection/fixtures/all/' . $demo_key);
    exit;
  }
?>