<?php
class Migration_Create_articles_media_table extends CI_Migration {

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 100,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'article_id' =>array(
				'type' => 'INT',
				'constraint' => 11,
			),
			'image_path' =>array(
				'type' => 'VARCHAR' ,
				'constraint' => 255,
				'null' => TRUE,

			),			
			'image_caption' =>array(
				'type' => 'VARCHAR' ,
				'constraint' => 255,
				'null' => TRUE,

			),

		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('articles_media');
	}

	public function down()
	{
		$this->dbforge->drop_table('articles_media');
	}
}