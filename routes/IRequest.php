<?php
namespace routes;
interface IRequest
{
    public function getBody();
    public function getContent();
}