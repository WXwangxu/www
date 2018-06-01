<?php
namespace core\model;


    class Base{
//        定义pdo对象属性
        protected $pdo;
//        定义表名属性
        protected $table;
//        定义where条件属性
        protected static $where;
//        定义静态主键值属性
        protected static $pri;


//        定义构造函数
        public function __construct($config,$table)
        {
//         将$table表名变成一个属性,为了后面的其他方法使用
            $this->table = $table;
//            p($this->table);
//            自动调用连接数据库方法
            $this->connect($config);
//            p($this->pdo);
        }


//        链接数据库的方法
        public function connect($config){
//            p($config);
            if (is_null($this->pdo)){
                $dsn = 'mysql:host='.$config['host'].';dbname='.$config['dbname'];
//                            p($dsn);
                try{
                    $this->pdo = new \PDO($dsn,$config['username'],$config['password']);
//                    设置字符集
                    $this->pdo->query('set names utf8');
            }catch (\PDOException $e){
                    die($e->getMessage());
                }
            }
        }

//        获得多条数据
        public function get(){
//            组合sql语句
            $sql = "select * from ".$this->table . self::$where;
//            p($sql);
            //通过pdo对象调用query方法获取多条数据
            $result = $this->pdo->query($sql);
//            p($result);
            $data = $result->fetchAll(\PDO::FETCH_ASSOC);
//              p($data);
            //将当前$data数据存入当前对象的一个临时属性中
            $this->data = $data;
            //返回当前对象
            return $this;
        }


//            获取单条数据
        public function find($pri){
//            获取调用表的主键名
            $priKey = $this->getPriKey();
//            组sql语句
            $sql = "select * from ".$this->table." where ".$priKey." = " . $pri;
//            p($sql);
//            通过pdo对象调用query方法获取数据
            $result = $this->pdo->query($sql);
            $data = $result->fetch(\PDO::FETCH_ASSOC);
            //将当前$data数据存入当前对象的一个临时属性中
            $this->data = $data;
            //将查找的主键的值存入当前对象的属性
            self::$pri = $pri;
            //返回当前对象
            return $this;
        }

//        获取主键名称
    public function getPriKey(){
//            组合查看表结构的sql语句
        $sql=  'desc ' . $this->table;
        $result = $this->pdo->query($sql);
//        循环$result，如果$v里面的Key = PRI，就代表当前字段是主键
//        定义空字符串接收主键名称的变量
        $priKey = '';
        foreach($result as $k => $v ){
            if($v['Key'] == 'PRI'){
                $priKey = $v['Field'];
                break;
            }
        }
//        将主键名称返回
        return $priKey;
    }

//    将对象转成数组
    public function toArray(){
            return $this->data;
    }

//    组合where语句
    public function where($where){
        self::$where = " where " . $where;
        return $this;
    }

//    添加数据方法
    public function add($data){
//        循环$data需要存入的数据
//        定义一个接收字段名的字符串
        $keyStr = '';
//        定义一个接收字段值的字符串
        $valueStr = '';
//        循环$data
        foreach($data as $k =>$v){
          $keyStr .= $k . ',';
          $valueStr .= '"'.$v . '",';
        }
//        将最后的逗号去掉
        $keyStr = rtrim($keyStr,',');
        $valueStr = rtrim($valueStr,',');

//        组合sql语句
        $sql = 'insert into '.$this->table.' ('.$keyStr.') values ('.$valueStr.')';
//        p($sql);
//        用pdo对象调用exec方法来完成添加
        $data = $this->pdo->exec($sql);
//        将$data返回
        return $data;
    }


//        编辑数据方法
        public function edit($data){
//          循环$data,组合sql语句中需要的字符串
//            定义一个空字符串
            $str = '';
            foreach($data as $k => $v){
                $str .=$k . ' ="' . $v .'",';
            }
//            去掉逗号
            $str = rtrim($str,',');
//            获取主键名称
            $priKey = $this->getPriKey();
//            组sql语句
            $sql = "update ".$this->table." set ".$str. " where ".$priKey." = " . self::$pri;
//            使用pdo对象来调用exec方法修改数据
            $data = $this->pdo->exec($sql);
//            将$data返回
            return $data;

        }


//        删除数据方法
    public function delete($pri){
        //组合sql语句
        //获取主键名称
        $priKey = $this->getPriKey();
//        $sql = "delete from user where id = 1";
        $sql = "delete from ".$this->table." where ".$priKey." = " . $pri;
        //使用pdo对象调用exec方法来修改数据
        $data = $this->pdo->exec($sql);
        //将$data返回
        return $data;
    }

//        多表查询的query方法
        public function query($sql){
//            直接使用pdo对象调用PDO的query方法获取关联表的数据
            $result = $this->pdo->query($sql);
            $data = $result->fetchall(\PDO::FETCH_ASSOC);
            $this->data = $data;
            return $this;
        }



    }


?>