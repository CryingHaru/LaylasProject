/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MariaDB
 Source Server Version : 100421 (10.4.21-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : db_tienda

 Target Server Type    : MariaDB
 Target Server Version : 100421 (10.4.21-MariaDB)
 File Encoding         : 65001

 Date: 20/06/2024 15:10:37
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tbl_cab_ventas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cab_ventas`;
CREATE TABLE `tbl_cab_ventas`  (
  `id_cab_venta` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` date NULL DEFAULT NULL,
  `id_cliente` int(10) UNSIGNED NULL DEFAULT NULL,
  `total` decimal(10, 2) UNSIGNED NULL DEFAULT NULL,
  `estado` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_cab_venta`) USING BTREE,
  INDEX `cliente`(`id_cliente`) USING BTREE,
  CONSTRAINT `FK_CLIENTE` FOREIGN KEY (`id_cliente`) REFERENCES `tbl_clientes` (`id_cliente`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 56 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_cab_ventas
-- ----------------------------
INSERT INTO `tbl_cab_ventas` VALUES (53, '2024-06-19', 5, 1332.00, '0');

-- ----------------------------
-- Table structure for tbl_categorias
-- ----------------------------
DROP TABLE IF EXISTS `tbl_categorias`;
CREATE TABLE `tbl_categorias`  (
  `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_categorias
-- ----------------------------
INSERT INTO `tbl_categorias` VALUES (1, 'tests');

-- ----------------------------
-- Table structure for tbl_clientes
-- ----------------------------
DROP TABLE IF EXISTS `tbl_clientes`;
CREATE TABLE `tbl_clientes`  (
  `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `telefono` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `dui_nit` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_cliente`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_clientes
-- ----------------------------
INSERT INTO `tbl_clientes` VALUES (1, 'Cliente Generico', '', '', NULL);
INSERT INTO `tbl_clientes` VALUES (2, 'Mario', 'La Union', '89788778', '887665545-2');
INSERT INTO `tbl_clientes` VALUES (3, 'Pablo', 'San Vicente', '78787547', '68255565-5');
INSERT INTO `tbl_clientes` VALUES (4, 'Manuel', 'Estados Unidos', '+1755545', '');
INSERT INTO `tbl_clientes` VALUES (5, 'Andres', 'M', '00000000', '14545426-2');
INSERT INTO `tbl_clientes` VALUES (6, 'Juansito', 'San Miguel', '77788899', '1514545465-2');

-- ----------------------------
-- Table structure for tbl_det_ventas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_det_ventas`;
CREATE TABLE `tbl_det_ventas`  (
  `tbl_det_ventas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_cab_venta` int(10) UNSIGNED NOT NULL,
  `id_producto` int(10) UNSIGNED NOT NULL,
  `cantidad` int(10) NULL DEFAULT NULL,
  `precio_unitario` decimal(8, 2) NULL DEFAULT NULL,
  PRIMARY KEY (`tbl_det_ventas`) USING BTREE,
  INDEX `cab`(`id_cab_venta`) USING BTREE,
  INDEX `producto`(`id_producto`) USING BTREE,
  CONSTRAINT `FK_CAB_VENTA` FOREIGN KEY (`id_cab_venta`) REFERENCES `tbl_cab_ventas` (`id_cab_venta`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_PRODUCTO` FOREIGN KEY (`id_producto`) REFERENCES `tbl_productos` (`id_producto`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_det_ventas
-- ----------------------------
INSERT INTO `tbl_det_ventas` VALUES (36, 53, 1, 12, 111.00);

-- ----------------------------
-- Table structure for tbl_marcas
-- ----------------------------
DROP TABLE IF EXISTS `tbl_marcas`;
CREATE TABLE `tbl_marcas`  (
  `id_marca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_marca`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_marcas
-- ----------------------------
INSERT INTO `tbl_marcas` VALUES (1, 'asd');
INSERT INTO `tbl_marcas` VALUES (2, 'asdasd');
INSERT INTO `tbl_marcas` VALUES (3, 'asdasdasd');

-- ----------------------------
-- Table structure for tbl_productos
-- ----------------------------
DROP TABLE IF EXISTS `tbl_productos`;
CREATE TABLE `tbl_productos`  (
  `id_producto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_marca` int(10) UNSIGNED NOT NULL,
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `detalles` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `existencias` int(10) UNSIGNED NULL DEFAULT NULL,
  `precio_venta` decimal(8, 2) NULL DEFAULT NULL,
  `imagen` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_producto`) USING BTREE,
  INDEX `marca`(`id_marca`) USING BTREE,
  INDEX `categoria`(`id_categoria`) USING BTREE,
  CONSTRAINT `FK_CATEGORIA` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categorias` (`id_categoria`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `FK_MARCA` FOREIGN KEY (`id_marca`) REFERENCES `tbl_marcas` (`id_marca`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_productos
-- ----------------------------
INSERT INTO `tbl_productos` VALUES (1, 'Curls', 1, 1, '123', 87, 111.00, '../../assets/images/img_productos/prod_20240619051913.png');

-- ----------------------------
-- Table structure for tbl_usuarios
-- ----------------------------
DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE `tbl_usuarios`  (
  `id_usuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `usuario` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tipo_cuenta` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tbl_usuarios
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
