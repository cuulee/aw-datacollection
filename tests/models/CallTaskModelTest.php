<?php

class CallTaskModelTest extends PHPUnit_Framework_TestCase
{
  
  private static $CI;
  
  public static function setUpBeforeClass() {
    self::$CI =& get_instance();
    
    // Clean db!
    self::$CI->mongo_db->dropDb('aw_datacollection_test');
    
    self::$CI->load->model('call_task_model');
    
    // Some data!
    $fixture = array(
      
      ///////
        // Assigned and completed.
      ///////
    
      // 5 times no reply
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000000",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
    
      // 5 times no reply and a cant complete.
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000001",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::CANT_COMPLETE,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      // Invalid number
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000002",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::INVALID_NUMBER,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      // Successful.
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000003",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::SUCCESSFUL,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      // No interest.
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000004",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_INTEREST,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      // Number Change.
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000005",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::NUMBER_CHANGE,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      // Discard.
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000006",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::DISCARD,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      ///////
        // Assigned and to finish.
      ///////
      
      // Cant Complete.
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000007",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::CANT_COMPLETE,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          )
        )
      ),
      
      // No Reply >5
      array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => "1000000000008",
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array(
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
          array(
            'code' => Call_task_status::NO_REPLY,
            'message' => NULL,
            'author' => 1,
            'created' => Mongo_db::date()
          ),
        )
      ),
    );
    
    // Assigned and Not Started.
    for($r = 0; $r < 10; $r++) {
      $fixture[] =  array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => (string)(1000000000000 + $r + 100),
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => Mongo_db::date(),
        'author' => 1,
        'assignee_uid' => 1,
        'survey_sid' => 1,
        'activity' => array()
      );
    }
    
    // Unassigned.
    for($r = 0; $r < 10; $r++) {
      $fixture[] =  array(
        'ctid' => increment_counter('call_task_ctid'),
        'number' => (string)(1000000000000 + $r + 1000),
        'created' => Mongo_db::date(),
        'updated' => Mongo_db::date(),
        'assigned' => NULL,
        'author' => 1,
        'assignee_uid' => NULL,
        'survey_sid' => 1,
        'activity' => array()
      );
    }
    
    self::$CI->mongo_db->batchInsert(Call_task_model::COLLECTION, $fixture);
    
  }
  
  public static function tearDownAfterClass() {
    // Clean up your mess.
    self::$CI->mongo_db->dropDb('aw_datacollection_test');
    
  }
  
  public function test_get_user_resolved_call_tasks() {
    $resolved = self::$CI->call_task_model->get_resolved(1, 1);
    
    $this->assertEquals(7, count($resolved));
    
    // The get_resolved leaves the no_reply (x5) status to the end
    // so the call tasks are not properly ordered. It is not an important issue
    // and is outside the scope of get_resolved. If needed can be ordered later.
    $this->assertEquals('1000000000002', $resolved[0]->number);
    $this->assertEquals('1000000000003', $resolved[1]->number);
    $this->assertEquals('1000000000004', $resolved[2]->number);
    $this->assertEquals('1000000000005', $resolved[3]->number);
    $this->assertEquals('1000000000006', $resolved[4]->number);
    
    $this->assertEquals('1000000000001', $resolved[5]->number);
    $this->assertEquals('1000000000000', $resolved[6]->number);
    
  }
}

?>