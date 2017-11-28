<?php
class Migration_Create_settings extends CI_Migration {

public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'TINYINT',
				'constraint' => 1,
				'unsigned' => TRUE,
				'default' => 0,
			),
			'webpage_title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'meta_keywords' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'meta_description' => array(
				'type' => 'TEXT',
			),
			'seo_page_title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'logo_image' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'created' => array(
				'type' => 'DATETIME',
			),
			'created_by' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'modified' => array(
				'type' => 'DATETIME',
				'null' => TRUE,
			),
			'modified_by' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE,
			),
			'min_password_length' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 8,
			),
			'google_analytics_tracking_id' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				'null'		=> TRUE,
				)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('settings');

		$data = array(
			array(
				'id' 						=> 	"0",
				'webpage_title'				=>	"Amazing Startup",
				'created'					=>	date('Y-m-d H:i:s'),
				'meta_keywords'				=>	"New Webpage, New Site, Welcome",
				'meta_description'			=>	"Helo World.This is our very new webpage, created with BlogIt.",
				'seo_page_title'			=>	"Welcome",
				'logo_image'				=> 	"",
				'min_password_length'		=> 	"8",

			), 
		);

		$this->db->insert_batch('settings', $data);
	}

	public function down()
	{
		$this->dbforge->drop_table('settings');
	}
}