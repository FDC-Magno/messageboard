<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Message $Message
 * @property Conversations $Conversations
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'minLength' => array(
				'rule' => array('minLength', '5'),
				'message' => 'Name must be at least 5 chars long',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name is required',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Email must be valid',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'E-mail is required',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'unique' => array(
                'rule' => array('isUnique'),
				'message' => 'This email is already in use',
				'on' => 'create'
            )
		),
		'password' => array(
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'message' => 'Password must be at least 6 letters long',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),   
        'password_confirm' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
                'message' => 'Please confirm your password',
				'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Both passwords must match.',
				'on' => 'create', // Limit validation to 'create' or 'update' operations
            )
		),
		//FIXED(Jann 02/12/2020):changed validation type from mimeType to extension validation due to "Cannot determine mimeType" error
		'image' => array(
			'extension' => array(
				'rule'    => array('extension', array('gif', 'jpeg', 'png', 'jpg')),
				'message' => 'Please supply a valid image.'
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Image is required',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gender' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Gender is required',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'birthdate' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Birthdate is required',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'born' => array(
				'rule'       => array('date', 'ymd'),
				'message'    => 'Enter a valid date in YY-MM-DD format.',
				'allowEmpty' => true
			)
		),
		'hubby' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Hubby is required',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', '255'),
				'message' => 'Maximum length of hubby is 255 chars',
				//'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'Message.created ASC',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => array('Message.read' => 'NULL')
		),
		'Conversation' => array(
			'className' => 'Conversation',
			'foreignKey' => 'receiver_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => array('id', 'receiver_id', 'sender_id', 'created'),
			'order' => '',
			'limit' => '10',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	//FIXED(Jann 02/10/2020): Need to prevent rehashing on user edit
	public function beforeSave($options = array()){
		// check if user wants to create or edit files
		// var_dump($this->id);
		if(empty($this->id)){
			$this->data[$this->alias]['password'] = AuthComponent::password(
				$this->data[$this->alias]['password']
			);
			return true;
		}
	}

	// password confirmation on user signup
	public function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }
}
