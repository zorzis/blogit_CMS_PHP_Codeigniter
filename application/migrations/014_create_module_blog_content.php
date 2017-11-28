<?php
class Migration_Create_module_blog_content extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 11,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'module_id' =>array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'category_id' =>array(
				'type' => 'INT' ,
				'constraint' => 11,
			),

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('module_blog_content');
	}

	public function down()
	{
		$this->dbforge->drop_table('module_blog_content');
	}
}