<?php

namespace app\model;

use \PDO;

class SPDO
{
    /**
     * Instance de la classe PDO
     *
     * @var \PDO
     * @access private
     */
    private $PDOInstance = null;

    /**
     * Instance de la classe SPDO
     *
     * @var SPDO
     * @access private
     * @static
     */
    private static $instance = null;

    /**
     * Constante: nom d'utilisateur de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_USER = 'postgres';

    /**
     * Constante: hôte de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_HOST = '127.0.0.1';

    /**
     * Constante: hôte de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_PASS = 'postgres';

    /**
     * Constante: nom de la bdd
     *
     * @var string
     */
    const DEFAULT_SQL_DTB = 'dbcsi';

    /**
     * Constructeur
     *
     * @param void
     * @return void
     * @see PDO::__construct()
     * @access private
     */
    private function __construct()
    {
        try{
            $this->PDOInstance = new \PDO('pgsql:dbname='.self::DEFAULT_SQL_DTB.';host='.self::DEFAULT_SQL_HOST,self::DEFAULT_SQL_USER ,self::DEFAULT_SQL_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        }
        catch (\PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    /**
     * Crée et retourne l'objet SPDO
     *
     * @access public
     * @static
     * @param void
     * @return SPDO $instance
     */
    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new SPDO();
        }
        return self::$instance;
    }

    public function getPDOInstance() {
        return $this->PDOInstance;
    }

    /**
     * Exécute une requête SQL avec PDO
     *
     * @param string $query La requête SQL
     * @return \PDOStatement Retourne l'objet PDOStatement
     */
    public function query($query)
    {
        return $this->PDOInstance->prepare($query);
    }
}
