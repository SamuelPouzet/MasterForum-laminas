<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ForumSubject extends \Application\Entity\ForumSubject implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Proxy\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array<string, null> properties to be lazy loaded, indexed by property name
     */
    public static $lazyPropertiesNames = array (
);

    /**
     * @var array<string, mixed> default values of properties to be lazy loaded, with keys being the property names
     *
     * @see \Doctrine\Common\Proxy\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array (
);



    public function __construct(?\Closure $initializer = null, ?\Closure $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', 'id', 'category_id', 'category', 'subjects', 'date_created', 'title', 'catchphrase', 'type', 'status', 'topics'];
        }

        return ['__isInitialized__', 'id', 'category_id', 'category', 'subjects', 'date_created', 'title', 'catchphrase', 'type', 'status', 'topics'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ForumSubject $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy::$lazyPropertiesDefaults as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @deprecated no longer in use - generated code now relies on internal components rather than generated public API
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getArrayCopy(): array
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getArrayCopy', []);

        return parent::getArrayCopy();
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): int
    {
        if ($this->__isInitialized__ === false) {
            return  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setId(int $id): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategoryId(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategoryId', []);

        return parent::getCategoryId();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategoryId(int $categoryId): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategoryId', [$categoryId]);

        return parent::setCategoryId($categoryId);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateCreated(): \DateTime
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateCreated', []);

        return parent::getDateCreated();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateCreated(\DateTime $date_created): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateCreated', [$date_created]);

        return parent::setDateCreated($date_created);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle(string $title): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', [$title]);

        return parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getCatchphrase(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCatchphrase', []);

        return parent::getCatchphrase();
    }

    /**
     * {@inheritDoc}
     */
    public function setCatchphrase(string $catchphrase): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCatchphrase', [$catchphrase]);

        return parent::setCatchphrase($catchphrase);
    }

    /**
     * {@inheritDoc}
     */
    public function getType(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', []);

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setType(int $type)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', [$type]);

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getForum(): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getForum', []);

        return parent::getForum();
    }

    /**
     * {@inheritDoc}
     */
    public function setForum(\Application\Entity\Forum $forum): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setForum', [$forum]);

        return parent::setForum($forum);
    }

    /**
     * {@inheritDoc}
     */
    public function getTopics(): \Doctrine\ORM\PersistentCollection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTopics', []);

        return parent::getTopics();
    }

    /**
     * {@inheritDoc}
     */
    public function addTopic(\Application\Entity\ForumTopic $topic): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTopic', [$topic]);

        return parent::addTopic($topic);
    }

    /**
     * {@inheritDoc}
     */
    public function razSubjects(): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'razSubjects', []);

        return parent::razSubjects();
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategory', []);

        return parent::getCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory($category)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategory', [$category]);

        return parent::setCategory($category);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubjects()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubjects', []);

        return parent::getSubjects();
    }

    /**
     * {@inheritDoc}
     */
    public function setSubjects($subjects)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSubjects', [$subjects]);

        return parent::setSubjects($subjects);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus($status)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

}
