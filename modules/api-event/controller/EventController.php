<?php
/**
 * EventController
 * @package api-event
 * @version 0.0.1
 */

namespace ApiEvent\Controller;

use LibFormatter\Library\Formatter;

use Event\Model\Event;

class EventController extends \Api\Controller
{
    public function indexAction(){
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        list($page, $rpp) = $this->req->getPager();

        $cond = [];
        if($q = $this->req->getQuery('q'))
            $cond['q'] = $q;
        if($month = $this->req->getQuery('month')){
            $dstart = $month . '-01 00:00:00';
            $dend   = $month . '-' . date('t', strtotime($dstart)) . ' 23:59:59';
            $cond['time_start'] = ['__between', $dstart, $dend];
        }
        
        $events = Event::get($cond, $rpp, $page, ['id' => 'DESC']);
        $events = !$events ? [] : Formatter::formatMany('event', $events, ['user']);

        foreach($events as &$pg)
            unset($pg->content, $pg->meta);
        unset($pg);

        $this->resp(0, $events, null, [
            'meta' => [
                'page'  => $page,
                'rpp'   => $rpp,
                'total' => Event::count($cond)
            ]
        ]);
    }

    public function singleAction(){
        if(!$this->app->isAuthorized())
            return $this->resp(401);

        $identity = $this->req->param->identity;

        $event = Event::getOne(['id'=>$identity]);
        if(!$event)
            $event = Event::getOne(['slug'=>$identity]);

        if(!$event)
            return $this->resp(404);

        $format_opts = ['user'];
        if(module_exists('event-venue'))
            $format_opts[] = 'organizer';
        $event = Formatter::format('event', $event, $format_opts);
        unset($event->meta);

        $this->resp(0, $event);
    }
}