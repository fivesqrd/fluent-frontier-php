<?php


class Fluent
{
    public static $defaults = array(
        'key'       => null,
        'secret'    => null,
        'sender'    => null,
        'format'    => 'markup',
        'transport' => 'remote'
    );
    
    /**
     * @param string $content
     * @param array $defaults
     * @return \Fluent\Message
     */
    public static function message($template = null, $defaults = null)
    {
        if ($template instanceof \Fluent\Template) {
            $content = $template->getContent();
        } else {
            $content = new \Fluent\Content();
        }
        
        if ($defaults === null) {
            $defaults = self::$defaults;
        }
        
        return new \Fluent\Message($content, $defaults);
    }

    /**
     * @param array $defaults
     * @return \Fluent\Message
     */
    public static function event($defaults = null)
    {
        if ($defaults === null) {
            $defaults = self::$defaults;
        }

        return new \Fluent\Event(
            new Fluent\Api($defaults['key'], $defaults['secret'])
        );
    }
}
