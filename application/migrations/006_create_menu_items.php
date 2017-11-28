<?php
class Migration_Create_menu_items extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'menu_id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'page_id' => array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'parent_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0, 
			),	
			'priority_order' => array(
				'type' => 'INT',
				'constraint' => 11,
				'null' => TRUE, 
			),
			'privilege_id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'default' => 0,
			)		

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('menu_items');
	}

	public function down()
	{
		$this->dbforge->drop_table('menu_items');
	}
}