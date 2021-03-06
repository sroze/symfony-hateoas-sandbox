<?php

namespace AdrienBrault\ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use FSC\HateoasBundle\Annotation as Hateoas;

/**
 * @ORM\Entity
 * @ORM\Table(name = "task")
 *
 * @Serializer\XmlRoot("task")
 *
 * @Hateoas\Relation("self", href = @Hateoas\Route("api_task_get", parameters = { "id" = ".id" }))
 * @Hateoas\Relation("edit",
 *      href = @Hateoas\Route("api_task_form_edit", parameters = { "id" = ".id" }),
 *      embed = @Hateoas\Content(
 *          provider = { "fsc_hateoas.factory.form_view", "formFactoryCreateNamed" },
 *          providerArguments = { { "task", "adrienbrault_task", "@" }, "PUT", "api_task_edit", { "id" = ".id" } },
 *          serializerXmlElementName = "form"
 *      )
 * )
 */
class Task
{
    /**
     * @var int
     *
     * @ORM\Column(type = "integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy = "AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type = "string", length = 255)
     *
     * @Assert\NotBlank(groups = { "create", "edit" })
     * @Assert\Length(min = 5, max = 255, groups = { "create", "edit" })
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type = "text")
     *
     * @Assert\Length(min = 5, max = 3000, groups = { "create", "edit" })
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(type = "boolean", name = "is_done")
     *
     * @Serializer\SerializedName("isDone")
     *
     * @Assert\Type(type = "boolean", groups = { "edit" })
     */
    protected $isDone;

    public function __construct()
    {
        $this->isDone = false;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return boolean
     */
    public function getIsDone()
    {
        return $this->isDone;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param boolean $isDone
     */
    public function setIsDone($isDone = true)
    {
        $this->isDone = $isDone;
    }
}
