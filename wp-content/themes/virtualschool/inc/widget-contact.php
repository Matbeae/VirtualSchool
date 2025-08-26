<?php
class SI_Widget_Contact extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'si_widget_contact',
            'Контакт',
            [
                'name' => 'Контакт кастом',
                'description' => 'Выводит номер телефона',
            ]
        );
    }
    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('id-tel'); ?>">
                Номер телефона:
            </label>
            <input id="<?php echo $this->get_field_id('id-tel'); ?>" type="text"
                name="<?php echo $this->get_field_name('tel') ?>" value="<?php echo $instance['tel']; ?>" class="widefat">
        </p>
        <?php
    }
    public function widget($args, $instance)
    {
        ?>
        <div itemscope itemtype="http://schema.org/Organization" class="header_contacts_text">
            <p>Звонить по номеру: </p>
            <a itemprop="telephone" href="tel:<?php echo $instance['tel']; ?>">
                <?php echo $instance['tel']; ?>
            </a>
        </div>
        <?php
    }
    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}

?>