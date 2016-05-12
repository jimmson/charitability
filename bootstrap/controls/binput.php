<?php
 namespace bootstrap\controls;

 use bones\controls\input;
 use bones\containers\div;
 use bones\controls\label;
 
 class binput extends input
 {

    const INLINE = 1;

    private $label_control;
    private $form_layout;

    public function __construct( $_name, $_type = self::TEXT )
    {
        parent::__construct( $_name, $_type, $_form_layout = 1);
        
        $this->set_element("input");
        $this->set_renderer("b_render_control");

        $this->form_layout = $_form_layout;

    }

    public function set_label( $_text )
    {
        $this->label_control = new label("label");
        $this->label_control->set_text( $_text );
    }
 
    public function get_label()
    {
        return $this->label_control; 
    }

    protected function b_render_control()
    {
        $this->set_renderer(self::DEFAULT_RENDERER);

        $div_group = new div("");

        if ( !$this->get_id() )
        {   
            $this->set_id( $this->get_name() );
            $this->label_control->set_for( $this->get_id() );
        }

        $div_group           ->set_class("form-group"); 
        $this->label_control ->set_class("control-label");

        $div_group->add( $this->label_control);

        if ($this->form_layout == self::INLINE)
        {
            $div_wrap            = new div("");
            $div_wrap            ->set_class("col-sm-8"); 
            $this->label_control ->set_class("col-sm-4 ");
            $div_wrap ->add( $this);
            $div_group->add( $div_wrap );
        }
        else
        {
            $div_group->set_class("col-sm-12"); 
            $div_group->add( $this );
        }

        $div_group->render();

    }
 }


