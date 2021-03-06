<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class ForumTopic extends \Application\Entity\ForumTopic implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', 'id', 'subject_id', 'subject', 'date_created', 'title', 'catchphrase', 'status', 'type', 'responses', 'custom_response', 'custom_template'];
        }

        return ['__isInitialized__', 'id', 'subject_id', 'subject', 'date_created', 'title', 'catchphrase', 'status', 'type', 'responses', 'custom_response', 'custom_template'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (ForumTopic $proxy) {
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
    public function getArrayCopy()
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
    public function setId(int $id): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        return parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubjectId(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubjectId', []);

        return parent::getSubjectId();
    }

    /**
     * {@inheritDoc}
     */
    public function setSubjectId(int $subject_id): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSubjectId', [$subject_id]);

        return parent::setSubjectId($subject_id);
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
    public function setDateCreated(\DateTime $date_created): \Application\Entity\ForumTopic
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
    public function setTitle(string $title): \Application\Entity\ForumTopic
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
    public function setCatchphrase(string $catchphrase): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCatchphrase', [$catchphrase]);

        return parent::setCatchphrase($catchphrase);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubject(): \Application\Entity\ForumSubject
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubject', []);

        return parent::getSubject();
    }

    /**
     * {@inheritDoc}
     */
    public function setSubject(\Application\Entity\ForumSubject $subject): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSubject', [$subject]);

        return parent::setSubject($subject);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(int $status): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        return parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getResponses(): \Doctrine\ORM\PersistentCollection
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getResponses', []);

        return parent::getResponses();
    }

    /**
     * {@inheritDoc}
     */
    public function addResponse(\Application\Entity\ForumResponse $response): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addResponse', [$response]);

        return parent::addResponse($response);
    }

    /**
     * {@inheritDoc}
     */
    public function razResponses(): \Application\Entity\ForumTopic
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'razResponses', []);

        return parent::razResponses();
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', []);

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', [$type]);

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomResponse()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomResponse', []);

        return parent::getCustomResponse();
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomResponse($custom_response)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomResponse', [$custom_response]);

        return parent::setCustomResponse($custom_response);
    }

    /**
     * {@inheritDoc}
     */
    public function getCustomTemplate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCustomTemplate', []);

        return parent::getCustomTemplate();
    }

    /**
     * {@inheritDoc}
     */
    public function setCustomTemplate($custom_template)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCustomTemplate', [$custom_template]);

        return parent::setCustomTemplate($custom_template);
    }

}
