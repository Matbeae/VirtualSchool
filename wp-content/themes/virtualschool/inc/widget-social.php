<?php
class SI_Widget_Social extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'si_widget_social',
            'Социальные иконки',
            [
                'name' => 'Социальные иконки кастом',
                'description' => 'Выводит иконки соц сетей',
            ]
        );
    }
    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('id-link-vk'); ?>">
                Вконтакте:
            </label>
            <input id="<?php echo $this->get_field_id('id-link-vk'); ?>" type="text"
                name="<?php echo $this->get_field_name('link-vk') ?>" value="<?php echo $instance['link-vk']; ?>"
                class="widefat">
            <label for="<?php echo $this->get_field_id('id-link-tg'); ?>">
                Телеграм:
            </label>
            <input id="<?php echo $this->get_field_id('id-link-tg'); ?>" type="text"
                name="<?php echo $this->get_field_name('link-tg') ?>" value="<?php echo $instance['link-tg']; ?>"
                class="widefat">
            <label for="<?php echo $this->get_field_id('id-link-fb'); ?>">
                Фейсбук:
            </label>
            <input id="<?php echo $this->get_field_id('id-link-fb'); ?>" type="text"
                name="<?php echo $this->get_field_name('link-fb') ?>" value="<?php echo $instance['link-fb']; ?>"
                class="widefat">
            <label for="<?php echo $this->get_field_id('id-link-inst'); ?>">
                Инстаграм:
            </label>
            <input id="<?php echo $this->get_field_id('id-link-inst'); ?>" type="text"
                name="<?php echo $this->get_field_name('link-inst') ?>" value="<?php echo $instance['link-inst']; ?>"
                class="widefat">
        </p>
        <?php
    }
    public function widget($args, $instance)
    {
        ?>
        <div class="footer_top_social">
            <p>Мы в соц. сетях</p>
            <ul>
                <li>
                    <a href="<?php echo $instance['link-vk']; ?>">
                        <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-vk-145813.png" height="35"
                            width="35" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo $instance['link-tg']; ?>">
                        <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-telegram-2111646.png" height="35"
                            width="35" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo $instance['link-fb']; ?>">
                        <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-facebook-145802.png" height="35"
                            width="35" />
                    </a>
                </li>
                <li>
                    <a href="<?php echo $instance['link-inst']; ?>">
                        <img src="<?php echo get_template_directory_uri() ?> /images/free-icon-instagram-3955024.png"
                            height="35" width="35" />
                    </a>
                </li>
            </ul>
        </div>
        <?php
    }
    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}

?>