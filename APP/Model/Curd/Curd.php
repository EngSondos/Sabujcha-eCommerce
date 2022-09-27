<?php 
namespace APP\Model\Curd;

interface Curd{
    function create();
    function update();
    function read();
    function delete();
}