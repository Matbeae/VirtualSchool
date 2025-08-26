<?php
class SI_Widget_Partner extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'si_widget_partner',
            'Партнер',
            [
                'name' => 'Партнер кастом',
                'description' => 'Выводит партнера',
            ]
        );
    }
    public function form($instance)
    {
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('id-partner-photo'); ?>">
                Вставьте URL ссылку на фото из медиафайлов:
            </label>
            <input id="<?php echo $this->get_field_id('id-partner-photo'); ?>" type="text"
                name="<?php echo $this->get_field_name('partner-photo') ?>" value="<?php echo $instance['partner-photo']; ?>"
                class="widefat">
            <label for="<?php echo $this->get_field_id('id-partner'); ?>">
                Название партнера:
            </label>
            <input id="<?php echo $this->get_field_id('id-partner'); ?>" type="text"
                name="<?php echo $this->get_field_name('partner') ?>" value="<?php echo $instance['partner']; ?>"
                class="widefat">
            <label for="<?php echo $this->get_field_id('id-partner-description'); ?>">
                Описание партнера:
            </label>
            <input id="<?php echo $this->get_field_id('id-partner-description'); ?>" type="text"
                name="<?php echo $this->get_field_name('partner-description') ?>"
                value="<?php echo $instance['partner-description']; ?>" class="widefat">
        </p>
        <?php
    }
    public function widget($args, $instance)
    {
        ?>
        <div class="block_one_sponsor" itemscope itemtype="http://schema.org/ImageObject">
            <img src="<?php echo $instance['partner-photo']; ?>" width="60" height="60" itemprop="contentUrl"/>
            <div class="block_one_sponsor_text">
                <p class="block_one_sponsor_text_name" itemprop="name">
                    <?php echo $instance['partner']; ?>
                </p>
                <p itemprop="description">
                    <?php echo $instance['partner-description']; ?>
                </p>
            </div>
        </div>
        <?php
    }
    public function update($new_instance, $old_instance)
    {
        return $new_instance;
    }
}

?>