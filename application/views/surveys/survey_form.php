<div class="row">
<?= validation_errors(); ?>
<?= form_open_multipart(); ?>
<?php
 // Only need sid if editing.
  if (isset($survey->sid)) {
    print form_hidden('survey_sid', $survey->sid);
  }
?>

  <?= form_label('Survey Title', 'survey_title'); ?>
  <?= form_input('survey_title', set_value('survey_title', property_if_not_null($survey, 'title'))); ?>
  
  <?= form_label('Status', 'survey_status'); ?>
  <?= form_dropdown('survey_status',
        Survey_entity::$allowed_status,
        set_value('survey_status', property_if_not_null($survey, 'status', array()))); ?>
        
  <?= form_upload('survey_file'); ?>
  
  <?= form_submit('survey_submit', 'Submit Survey'); ?>

<?= form_close(); ?>
</div>