<?php
namespace User\Form;

use Laminas\Captcha\Dumb;
use Laminas\Captcha\ReCaptcha;
use Laminas\Form\Element\Captcha;
use Laminas\Form\Form;
use Laminas\Validator\Hostname;

/**
 * This form is used to collect user's E-mail address (used to recover password).
 */
class PasswordResetForm extends Form
{
    /**
     * Constructor.     
     */
    public function __construct()
    {
        // Define form name
        parent::__construct('password-reset-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
                
        $this->addElements();
        $this->addInputFilter();          
    }
    
    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() 
    {
        // Add "email" field
        $this->add([            
            'type'  => 'email',
            'name' => 'email',
            'options' => [
                'label' => 'Your E-mail',
            ],
        ]);
        
        // Add the CAPTCHA field
        $this->add([
            'type' => Captcha::class,
            'name' => 'captcha',
            'options' => [
                'label' => 'Please verify you are human',
                'captcha' => new Dumb(),
                'font'=> './font/glyphicons-halflings-regular.ttf',
            ],
        ]);
        
        // Add the CSRF field
        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                'timeout' => 600
                ]
            ],
        ]);
        
        // Add the Submit button
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [                
                'value' => 'Reset Password',
                'id' => 'submit',
            ],
        ]);       
    }
    
    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() 
    {
        // Create main input filter
        $inputFilter = $this->getInputFilter();        
                
        // Add input for "email" field
        $inputFilter->add([
                'name'     => 'email',
                'required' => true,
                'filters'  => [
                    ['name' => 'StringTrim'],                    
                ],                
                'validators' => [
                    [
                        'name' => 'EmailAddress',
                        'options' => [
                            'allow' => Hostname::ALLOW_DNS,
                            'useMxCheck'    => false,                            
                        ],
                    ],
                ],
            ]);                     
    }        
}
