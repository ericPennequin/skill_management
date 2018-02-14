<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 14/02/2018
 * Time: 16:00
 */

require "Attachment.php";

class AttachmentsList
{
    public $id;
    public $idProject;
    public $attachments;

    /**
     * Attachment constructor.
     * @param int $idProject
     */
    public function __construct($idProject)
    {
        $this->idProject = $idProject;
        $this->attachments = $this->getAttachments();
    }

    protected function getAttachments()
    {
        $_REQUEST['command'] = "getAttachmentsList";
        $_REQUEST['id_project'] = $this->idProject;
        $result = array();
        include "../Model/Querys.php";

        $list = [];
        foreach ($result as $attachmentID) {
            $list[] = Attachment::withID($attachmentID);
        }

        return $list;
    }
}