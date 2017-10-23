<?php
namespace app\index\controller;

use shares\Shares;
use think\Controller;

class Index extends Controller
{
    public $seat = [
        1 => 4,
        2 => 5,
        3 => 6,
        4 => 6,
        5 => 5,
        6 => 5,
        7 => 8,
        8 => 8,
        9 => 8,
        10 => 8,
        11 => 8,
        12 => 8,
        13 => 8,
        14 => 7,
        15 => 6,
        16 => 6,
        17 => 6,
        18 => 6,
        19 => 5
    ];

    public $row;
    public $column;

    public function index()
    {
        //实例化获取腾讯当日开盘价的类并获取
        $shares = new Shares();
        $res = $shares->getShares();

        //获取今日日期
        $time = date("Y-m-d", time());

        //MD5
        $md5Str = md5($res.$time);
        $str = str_split($md5Str, 8);
        foreach ($str as $key => $value){
            $str[$key] = abs(intval(hexdec($value)));
        }

        //获取行
        $this->row = $str[0] % 19 + 1;

        //获取列
        $offset = $this->seat[$this->row] + 1;
        $this->column = $str[1] % $offset + 1;

        //传输变量
        return $this->fetch('',[
            'shares' => $res,
            'time' => $time,
            'row' => $this->row,
            'column' => $this->column
        ]);
    }

    public function seat()
    {
        //实例化获取腾讯当日开盘价的类并获取
        $shares = new Shares();
        $res = $shares->getShares();

        //获取今日日期
        $time = date("Y-m-d", time());

        //MD5
        $md5Str = md5($res.$time);
        $str = str_split($md5Str, 8);
        foreach ($str as $key => $value){
            $str[$key] = abs(intval(hexdec($value)));
        }

        //获取行
        $this->row = $str[0] % 19 + 1;
        $offset = $this->seat[$this->row] + 1;
        //获取列
        $this->column = $str[1] % $offset + 1;


        return $this->fetch('', [
            'row' => $this->row,
            'column' => $this->column
        ]);
    }
}
