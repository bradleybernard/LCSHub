<?php

class Match extends Eloquent {


    public function block()
    {
        return $this->belongsTo('Block', 'blockId', 'blockId');
    }

    public function scopeFinished($query)
    {
        return $query->where('isFinished', true);
    }

    public function cssClass()
    {
        if($this->isLive)
        return 'danger';


        if(!$this->isLive && !$this->isFinished)
        return 'info';


        if($this->isFinished)
        return 'success';

    }

    public function isLiveActive()
    {
        if($this->status() == 'Live')
        {
            return "active";
        }
    }

    public function isLiveText()
    {
        if($this->status() == 'Live')
        {
            return "color: white;";
        }
    }

    public function status()
    {
        if($this->isLive)
        {
            return 'Live';
        }

        if(!$this->isLive && !$this->isFinished)
        {
            return 'Scheduled';
        }

        if($this->isFinished && !$this->isLive)
        {
            return 'Finished';
        }
    }

    public function color()
    {
        if($this->status() == 'Live')
        {
            return '#ED5B56';
        }

        if($this->status() == 'Scheduled')
        {
            return '#5DC4EA';
        }

        if($this->status() == 'Finished')
        {
            return '#60C060';
        }
    }

    public function game()
    {
        return Game::where('matchId', $this->matchId)->first();
    }

    public function getGame()
    {
        if(!isset($this->_game))
        {
            $this->_game = Game::where('matchId', $this->matchId)->first();
        }

        return $this->_game;
    }

    public function winner($id)
    {
        if($this->winnerId == $id)
        {
            return "font-style: italic;";
        }
    }

    public function winnerImg($id)
    {
        if($this->winnerId == $id)
        {
            return "border: 3px solid #60C060;";
        }
    }

    public function winnerImgURL()
    {
        if($this->winnerId == $this->blueId)
        {
            return $this->blueLogoURL;
        }
        elseif($this->winnerId == $this->redId)
        {
            return $this->redLogoURL;
        }
    }

}
