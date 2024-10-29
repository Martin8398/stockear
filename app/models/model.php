<?php
require_once './config/config.php';

class model
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=" . MYSQL_HOST, MYSQL_USER, MYSQL_PASS);
        $this->_createDatabase();
        $this->db = new PDO("mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->_deploy();
    }

    private function _createDatabase()
    {
        $query = $this->db->query("SHOW DATABASES LIKE '" . MYSQL_DB . "'");
        $exists = $query->fetch();
        if (!$exists) {
            $this->db->exec("CREATE DATABASE IF NOT EXISTS `" . MYSQL_DB . "` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
        }
    }
    private function _deploy()
    {
        $query = $this->db->query("SHOW TABLES LIKE 'clientes'");
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            $sql = <<<END
            CREATE TABLE `categorias` (
                `id` int(11) NOT NULL,
                `nombre` varchar(30) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- Table structure for table `clientes`

                CREATE TABLE `clientes` (
                `id` int(11) NOT NULL,
                `nombre` varchar(20) NOT NULL,
                `apellido` varchar(20) NOT NULL,
                `dni` int(10) NOT NULL,
                `telefono` int(15) NOT NULL,
                `mail` varchar(50) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- Table structure for table `detalles_de_ventas`

                CREATE TABLE `detalles_de_ventas` (
                `id` int(11) NOT NULL,
                `venta_id` int(11) NOT NULL,
                `produto_id` int(11) NOT NULL,
                `cantidad` int(11) NOT NULL,
                `precio_unitario` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- Table structure for table `productos`

                CREATE TABLE `productos` (
                `id` int(11) NOT NULL,
                `nombre` varchar(30) NOT NULL,
                `descripcion` varchar(255) NOT NULL,
                `precio` int(11) NOT NULL,
                `categoria_id` int(11) NOT NULL,
                `stock` int(11) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- Table structure for table `usuarios`

                CREATE TABLE `usuarios` (
                `id` int(11) NOT NULL,
                `nombre` varchar(20) NOT NULL,
                `apellido` varchar(20) NOT NULL,
                `username` varchar(20) NOT NULL,
                `password` varchar(20) NOT NULL,
                `rol` enum('admin','vendedor') NOT NULL DEFAULT 'vendedor'
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- Table structure for table `ventas`

                CREATE TABLE `ventas` (
                `id` int(11) NOT NULL,
                `vendedor_id` int(11) NOT NULL,
                `cliente_id` int(11) NOT NULL,
                `fecha` date NOT NULL DEFAULT current_timestamp()
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                -- Indexes for dumped tables

                -- Indexes for table `categorias`

                ALTER TABLE `categorias`
                ADD PRIMARY KEY (`id`);

                -- Indexes for table `clientes`

                ALTER TABLE `clientes`
                ADD PRIMARY KEY (`id`),
                ADD UNIQUE KEY `dni` (`dni`);

                -- Indexes for table `detalles_de_ventas`

                ALTER TABLE `detalles_de_ventas`
                ADD PRIMARY KEY (`id`),
                ADD KEY `venta_id` (`venta_id`),
                ADD KEY `produto_id` (`produto_id`);

                -- Indexes for table `productos`

                ALTER TABLE `productos`
                ADD PRIMARY KEY (`id`),
                ADD KEY `categoria_id` (`categoria_id`);

                -- Indexes for table `usuarios`

                ALTER TABLE `usuarios`
                ADD PRIMARY KEY (`id`);

                -- Indexes for table `ventas`

                ALTER TABLE `ventas`
                ADD PRIMARY KEY (`id`),
                ADD KEY `vendedor_id` (`vendedor_id`),
                ADD KEY `cliente_id` (`cliente_id`);

                -- AUTO_INCREMENT for dumped tables

                -- AUTO_INCREMENT for table `categorias`

                ALTER TABLE `categorias`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                -- AUTO_INCREMENT for table `clientes`

                ALTER TABLE `clientes`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                -- AUTO_INCREMENT for table `detalles_de_ventas`

                ALTER TABLE `detalles_de_ventas`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                -- AUTO_INCREMENT for table `productos`

                ALTER TABLE `productos`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                -- AUTO_INCREMENT for table `usuarios`
                
                ALTER TABLE `usuarios`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                -- AUTO_INCREMENT for table `ventas`
                ALTER TABLE `ventas`
                MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

                -- Constraints for dumped tables

                -- Constraints for table `detalles_de_ventas`

                ALTER TABLE `detalles_de_ventas`
                ADD CONSTRAINT `detalles_de_ventas_ibfk_1` FOREIGN KEY (`venta_id`) REFERENCES `ventas` (`id`),
                ADD CONSTRAINT `detalles_de_ventas_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `productos` (`id`);

                -- Constraints for table `productos`

                ALTER TABLE `productos`
                ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

                -- Constraints for table `ventas`
                
                ALTER TABLE `ventas`
                ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`vendedor_id`) REFERENCES `usuarios` (`id`),
                ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`);
                COMMIT;
            END;

            $this->db->query($sql);
        }
    }
}
