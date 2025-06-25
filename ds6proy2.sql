-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2025 a las 19:35:12
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ds6proy2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `ImagenUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`Id`, `Nombre`, `Descripcion`, `ImagenUrl`) VALUES
(5, 'Computadoras', 'Explora nuestra amplia gama de computadoras de escritorio y portátiles. Desde opciones básicas para el hogar y la oficina hasta equipos de alto rendimiento para diseño, programación o gaming. Encuentra la computadora ideal con la mejor relación calidad-precio.', 'https://www.claroshop.com/c/algolia/assets/portada/laptops.webp'),
(6, 'Programas', 'Descubre nuestro catálogo de software para todas tus necesidades: productividad, seguridad, diseño, edición, contabilidad y más. Licencias originales, actualizaciones seguras y compatibilidad garantizada.', 'https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEityMljXj9d4hhTpymdY4ONpBup2i2Pk22ThGHxpqrwvF-bsKEJOS4780VxPesBtrvuauH0D6gC7kkBGRh9GCEW7MTEx7yIu1PxYN00KgLXvTfuQ-fhF8T79BzOZGhw3kh1X52ayqVFuMky/s400/licencias-windows-office-antivirus.jpg'),
(7, 'Monitores', 'Descubre nuestra amplia selección de monitores para todos los usos: trabajo, estudio, diseño gráfico o gaming. Encuentra modelos con excelente resolución, tecnología de última generación y tamaños que se adaptan a tus necesidades. Mejora tu experiencia visual con monitores de alta calidad y rendimiento.', 'https://sigmatiendas.com/cdn/shop/articles/monitores.webp?v=1729777960&width=2048'),
(8, 'UPS y Reguladores', 'Protege tus equipos electrónicos contra cortes de energía, picos de voltaje y fluctuaciones eléctricas. En esta sección encontrarás UPS (sistemas de alimentación ininterrumpida) y reguladores de voltaje ideales para mantener tus dispositivos seguros y funcionando sin interrupciones. Soluciones confiables para el hogar, la oficina o entornos profesionales.', 'https://support.forzaups.com/public/article/302/attachment/d8c2q2n6e1wert3mu28qcoce76x3e3w8/view'),
(9, 'Impresoras', 'Encuentra la impresora ideal para tu hogar u oficina. Disponemos de una amplia gama de modelos: impresoras láser, de inyección de tinta, multifuncionales y más. Imprime documentos, fotos y proyectos con alta calidad, eficiencia y conectividad moderna. Soluciones para cada necesidad y presupuesto.', 'https://cdn.shopify.com/s/files/1/0550/4604/5909/files/impresora_epson_f76913c9-3c66-4dc8-aff7-19bb3ad3877e_480x480.jpg?v=1728966882'),
(10, 'Electrónica', 'Todo lo que necesitas para instalaciones eléctricas y electrónicas en un solo lugar. Encuentra cables, conduits, conectores, luces LED, fuentes de poder y más. Productos de calidad para proyectos residenciales, comerciales o industriales. Seguridad, eficiencia y confiabilidad en cada componente.', 'https://blog.walthercuro.com/wp-content/uploads/2025/02/Electrona_basica_01.jpg'),
(11, 'Accesorios', 'Complementos esenciales para tu computadora, como mouse, teclados, audífonos, alfombrillas y más, diseñados para mejorar tu experiencia y productividad.', 'https://www.uticentrodavid.com/wp-content/uploads/2020/01/accesorios-de-computadoras.jpg'),
(12, 'Proyectores', 'Equipos y accesorios para proyección de imágenes y videos, ideales para presentaciones, clases o entretenimiento. Incluye proyectores, pantallas, soportes, cables y controles remotos.', 'https://mediaserver.goepson.com/ImConvServlet/imconv/4c92387a4409b357166ec1cdbfb6283cc63559a1/1200Wx1200H?use=banner&hybrisId=B2C&assetDescr=EB-PU2220B_blk-top-right-builtin-camera_690x460'),
(13, 'Sistemas de Seguridad', 'Dispositivos y soluciones para proteger hogares, oficinas y negocios. Incluye cámaras de vigilancia, alarmas, sensores de movimiento, videoporteros y kits de seguridad.', 'https://siesa.com.ar/wp-content/uploads/2017/07/153515_434167.jpg'),
(14, 'Redes y Comunicaciones', 'Equipos y accesorios para conectar y optimizar redes de datos. Incluye routers, switches, módems, cables de red, antenas y adaptadores para una comunicación eficiente y estable.', 'https://s.alicdn.com/@sc04/kf/H3067e1f2cfb046ea8bc24e14572b5a6f6.jpg_300x300.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `ID_categorias` int(11) DEFAULT NULL,
  `ImagenUrl` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Id`, `Nombre`, `Descripcion`, `Precio`, `ID_categorias`, `ImagenUrl`) VALUES
(11, 'Computadora Gaming MSI Codex R2 B14NUC7-095US', 'i7-14700F, 32GB DDR5, 2TB SSD, RTX4060 8GB GDDR6, WIndows 11 Home \r\nMarca: MSI\r\nModelo: CODEX R2 B14NUC7-095US', 1796.99, 5, 'https://img.ptytec.com/images/product/8956721722027664.jpg'),
(12, 'Computadora Gaming MSI Codex R2 C13NUC5-266US', 'i5-13400F, 16GB DDR5, 1TB SSD, RTX4060 8GB GDDR6, WIndows 11 Home\r\nMarca: MSI\r\nModelo: CODEX R2 C13NUC5-266US', 1193.99, 5, 'https://img.ptytec.com/images/product/1725461745337356.jpg'),
(13, 'Computadora GAMING ASUS ROG Strix G10 CE-US564', '5-11400F, 16GB DDR4, 512GB SSD, RTX3060 12GB, Windows 11 Home\r\nMarca: ASUS\r\nModelo: G10CE-US564', 1023.99, 5, 'https://img.ptytec.com/images/product/5316781669760950.jpg'),
(14, 'Computadora Gaming ASUS ROG Strix G16CHR-XS774', 'i7-14700F, 16GB DDR5, 1TB SSD, RTX4070, Windows 11 Pro\r\nMarca: ASUS\r\nModelo: G16CHR-XS774', 1843.99, 5, 'https://img.ptytec.com/images/product/6238571739029679.jpg'),
(15, 'Computadora Gaming Lenovo Legion Tower 7i Gen 8', 'i9-14900KF, 32GB DDR5, 2TB SSD, RTX4080 Super, Windows 11 Pro\r\nMarca: LENOVO\r\nModelo: 90V6000TUS', 2674.99, 5, 'https://img.ptytec.com/images/product/3547211729033044.jpg'),
(16, 'Computadora Gaming MSI CODEX R', 'i5-14400F, 32GB DDR5, 2TB SSD, RTX4060, Windows 11 Home\r\nMarca: MSI\r\nModelo: CODEX R 14NUC5-090US', 1541.99, 5, 'https://img.ptytec.com/images/product/9328641732113650.jpg'),
(17, 'Microsoft Office 2021', 'Suite de productividad para oficina y hogar.', 199.99, 6, 'https://digital-license-shop.com/wp-content/uploads/2021/10/office2021-english.png'),
(18, 'Adobe Photoshop CC', 'Software de edición de imágenes profesional.', 239.99, 6, 'https://tresbizz.com/wp-content/uploads/2023/02/PhotoshopCC.png'),
(19, 'AutoCAD 2024', 'Diseño asistido por computadora para ingeniería.', 1499.99, 6, 'https://lalicenza.it/wp-content/uploads/edd/2024/07/AutoDesk-AutocadLT2024-lalicenza.jpg'),
(20, 'Norton Antivirus Plus', 'Protección esencial para tu PC.', 39.99, 6, 'https://www.syntech.co.za/wp-content/uploads/2023/03/21426595_wr_01b-600x600.jpg'),
(21, 'CorelDRAW Graphics Suite', 'Herramientas de diseño gráfico y edición.', 499.99, 6, 'https://macrosoft.store/1269-large_default/coreldraw-graphics-suite-2023-mac.jpg'),
(22, 'Windows 11 Pro', 'Sistema operativo para computadoras personales.', 149.99, 6, 'https://cdn.panacompu.com/cdn-img/pv/microsoft-windows-11-pro.jpg?width=1200&height=630&fixedwidthheight=true'),
(23, 'QuickBooks Contabilidad', 'Software de contabilidad para negocios.', 299.99, 6, 'https://lirp.cdn-website.com/97852e4d/dms3rep/multi/opt/Quickbooks_Ebook-640w.png'),
(24, 'Sony Vegas Pro', 'Edición de video profesional.', 399.99, 6, 'https://vintageking.com/media/catalog/product/s/o/sony-vegas-pro-13-1.jpg?optimize=low&bg-color=255,255,255&fit=bounds&height=600&width=600&canvas=600:600'),
(25, 'MATLAB', 'Entorno de cálculo numérico y programación.', 999.99, 6, 'https://www.keysight.com/content/dam/keysight/en/img/migrated/scene7/products/12/PROD-1400139-01.png'),
(26, 'AVG Internet Security', 'Protección avanzada contra amenazas en línea.', 59.99, 6, 'https://crdms.images.consumerreports.org/prod/products/cr/models/398501-antivirus-for-windows-avg-internet-security-2019-10004916.png'),
(27, 'Monitor Samsung 24\" FHD', 'Pantalla LED Full HD, 75Hz.', 129.99, 7, 'https://www.multimax.net/cdn/shop/files/latin-t35f-422752-lf24t350fhnxza-532222631_2160_1_ed7cdb6c-7dce-46cf-87f3-1b1650b557b2_2048x.jpg?v=1710858270'),
(28, 'Monitor LG 27\" 4K UHD', 'Resolución 4K, IPS, HDR10.', 349.99, 7, 'https://www.lg.com/content/dam/channel/wcms/pa/images/monitores/27us500-w/gallery/ultrafine-27us500-gallery-01-2010.jpg/_jcr_content/renditions/thum-1600x1062.jpeg'),
(29, 'Monitor Dell 22\" IPS', 'Panel IPS, 60Hz, diseño delgado.', 119.99, 7, 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/peripherals/monitors/p-series/p2225h/mg/monitor-pseries-p2225h-bk-gallery-2.psd?fmt=pjpg&pscan=auto&scl=1&wid=4480&hei=3398&qlt=100,1&resMode=sharp2&size=4480,3398'),
(30, 'Monitor ASUS 32\" Curvo', 'Curvatura 1500R, 165Hz.', 399.99, 7, 'https://www.multimax.net/cdn/shop/files/fwebp_5b022ed0-16fa-42c5-871d-8984ab78fff8_2048x.webp?v=1708532941'),
(31, 'Monitor HP 23.8\" FHD', 'Tecnología antirreflejo, HDMI.', 139.99, 7, 'https://www.photura.com/cdn/shop/files/V24VG5_HP_Web_001.jpg?v=1728145211'),
(32, 'Monitor AOC 27\" Gaming', '144Hz, 1ms, FreeSync.', 229.99, 7, 'https://storage.aoc.com/assets/8421/AOC_27G2_PV_-FRONT-large.png'),
(33, 'Monitor BenQ 24\" EyeCare', 'Protección ocular, sin parpadeo.', 159.99, 7, 'https://m.media-amazon.com/images/I/71fldUuE52L._UF1000,1000_QL80_.jpg'),
(34, 'Monitor Philips 28\" 4K', 'Ultra HD, altavoces integrados.', 319.99, 7, 'https://images.philips.com/is/image/philipsconsumer/831b8c9573b54c0a8b5bb0150092fc2a?wid=700&hei=700&$pnglarge$'),
(35, 'Monitor ViewSonic 24\" VA', 'Panel VA, 75Hz, diseño sin bordes.', 129.99, 7, 'https://www.viewsonic.com/vsAssetFile/ap/img/slides/_lcd_display_%28new%29/VA2432-H/GPG-23-MON-VA2432-h-PRDP_F01_pc.png'),
(36, 'Monitor Acer 27\" Nitro', 'Gaming, 165Hz, 1ms.', 259.99, 7, 'https://m.media-amazon.com/images/I/91ZFBH2C67L.jpg'),
(37, 'UPS APC 600VA', 'Protección básica para PC y periféricos.', 69.99, 8, 'https://online.electrisa.com/image/cache/catalog/T-316soldout-458x599.png'),
(38, 'Regulador Forza 1200VA', 'Estabilizador de voltaje automático.', 39.99, 8, 'https://lynx-pay-prod.s3.amazonaws.com/c0xe6zdf6l6zulbmhrehrmnqw2dd'),
(39, 'UPS CyberPower 1500VA', 'Batería de respaldo para equipos críticos.', 149.99, 8, 'https://computercity.com/wp-content/uploads/71qnrtHaCQL.jpg'),
(40, 'Regulador Koblenz 1000VA', 'Protección contra picos de voltaje.', 29.99, 8, 'https://mx.all.biz/img/mx/catalog/33503.jpeg'),
(41, 'UPS Eaton 850VA', 'Respaldo para computadoras y routers.', 89.99, 8, 'https://www.eaton.com/mdmfiles/PDM32819463/5E850IUSB-TH_L/500x500_72dpi'),
(42, 'Regulador CDP 2000VA', 'Estabilizador para equipos electrónicos.', 49.99, 8, 'https://panama.solutekla.com/photo/1/cdp/reguladores_de_voltaje/regulador_cdp_avr2408_2000va1800w_8_tomas/regulador_cdp_avr2408_2000va1800w_8_tomas_0001'),
(43, 'UPS Tripp Lite 1000VA', 'Protección y respaldo de energía.', 119.99, 8, 'https://assets.tripplite.com/large-image/eco1000lcd-front-l.jpg'),
(44, 'Regulador Steren 1500VA', 'Protección para electrodomésticos.', 34.99, 8, 'https://m.media-amazon.com/images/I/31eFBR8zLhL.jpg_BO30,255,255,255_UF900,850_SR1910,1000,0,C_PIRIOFIVE-medium,BottomLeft,30,-20_QL100_.jpg'),
(45, 'UPS Forza 750VA', 'Batería de respaldo compacta.', 79.99, 8, 'https://forza-ups-frontend.s3.amazonaws.com/media/img/NT-751_02.jpg'),
(46, 'Regulador APC 1200VA', 'Estabilizador de voltaje premium.', 44.99, 8, 'https://cdn.panacompu.com/cdn-img/pv/apc-line-r-regulador-automatico-de-voltaje-preview.jpg?width=780&height=780&fixedwidthheight=false'),
(47, 'Impresora HP DeskJet 2720', 'Multifuncional inalámbrica.', 69.99, 9, 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c06626702.png'),
(48, 'Impresora Epson EcoTank L3250', 'Tanque de tinta, WiFi.', 189.99, 9, 'https://panaloptec.com/wp-content/uploads/2023/04/C11CJ67301-1.webp'),
(49, 'Impresora Brother HL-L2350DW', 'Láser monocromática, dúplex.', 129.99, 9, 'https://www.supricom.com.pa/wp-content/uploads/2023/06/HLL2350DW_main.webp'),
(50, 'Impresora Canon PIXMA G3110', 'Multifuncional, sistema continuo.', 159.99, 9, 'https://tonerspanama.com/admin/imagenes/P8X8G1H5182315C004AA.jpg'),
(51, 'Impresora Samsung Xpress M2020W', 'Láser compacta, WiFi.', 99.99, 9, 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c05726932.png'),
(52, 'Impresora HP LaserJet Pro M404n', 'Láser, alta velocidad.', 219.99, 9, 'https://movicenter.com.pa/wp-content/uploads/2022/09/Captura-de-pantalla-2022-09-05-112948.png'),
(53, 'Impresora Epson L120', 'Inyección de tinta, económica.', 89.99, 9, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThAEQlXXZospl7yuv7z0f22-CmrdCGcBF7wA&s'),
(54, 'Impresora Canon i-SENSYS LBP6030B', 'Láser, compacta.', 79.99, 9, 'https://i1.adis.ws/i/canon/i-sensys-lbp6030b-bk-fsl_story-module_01_425bf4fa37404bf8bf8ac1a36e2df56c?$block-multitext-1by1-dt-jpg$'),
(55, 'Impresora Brother DCP-T220', 'Multifuncional, tanque de tinta.', 139.99, 9, 'https://www.brother.com.mx/-/media/brother/product-catalog-media/images/2024/09/12/09/40/dcpt220.png'),
(56, 'Impresora HP Smart Tank 515', 'WiFi, impresión económica.', 179.99, 9, 'https://ssl-product-images.www8-hp.com/digmedialib/prodimg/lowres/c06405549.png'),
(57, 'Cable HDMI 2m', 'Transmisión de video y audio en alta definición.', 7.99, 10, 'https://assets.aten.com/product/image/2l-7d02h-1.cables.hdmi-cables.45.jpg'),
(58, 'Fuente de poder 500W', 'Fuente ATX para PC.', 34.99, 10, 'https://bannerlandpty.com/wp-content/uploads/2021/09/500w_xtech.jpg'),
(59, 'Tira LED RGB 5m', 'Iluminación decorativa multicolor.', 12.99, 10, 'https://carbonestore.com/cdn/shop/files/11_CL033-LES-04-110VRGB-Z-1_800x.jpg?v=1720031202'),
(60, 'Multímetro digital', 'Herramienta para medición eléctrica.', 19.99, 10, 'https://carbonestore.com/cdn/shop/files/46_UT33Cmas.jpg?v=1717008895'),
(61, 'Conector RJ45', 'Conector para cables de red.', 0.99, 10, 'https://korsakaonline.com/wp-content/uploads/2024/06/conector-rj45-cat6-1.png'),
(62, 'Lámpara LED 12W', 'Ahorro de energía, luz blanca.', 3.99, 10, 'https://idco.com.pa/cdn/shop/products/BH-149-0001_1c48020f-8c27-48d4-abac-7bc216cc85ed.jpg?v=1623604158'),
(63, 'Cinta aislante', 'Aislante para cables eléctricos.', 1.49, 10, 'https://media.doitcenter.com.pa/media/catalog/product/4/8/4873m158_2_qfblxxeikvr4prgx.jpg'),
(64, 'Regleta de 6 tomas', 'Protector de sobretensión.', 9.99, 10, 'https://media.doitcenter.com.pa/media/catalog/product/1/5/15526721_xoo7ruissgdgfk6z.jpg'),
(65, 'Transformador 12V', 'Fuente de alimentación para dispositivos.', 8.99, 10, 'https://carbonestore.com/cdn/shop/files/29_TS0814.jpg?v=1717012234'),
(66, 'Tester de cables', 'Comprobador de continuidad.', 14.99, 10, 'https://www.steren.com.pa/media/catalog/product/cache/532829604b379f478db69368d14615cd/image/2232858f8/probador-de-cables-de-red-utp-ftp-stp-y-telefonicos.jpg'),
(67, 'Mouse inalámbrico Logitech', 'Ergonómico, 2.4GHz.', 14.99, 11, 'https://www.multimax.net/cdn/shop/files/bazooka-magenta-gallery-6.jpg?v=1740499244'),
(68, 'Teclado mecánico Redragon', 'Retroiluminado, switches blue.', 39.99, 11, 'https://syscomstore.com/image/cache/catalog/productos/Teclado/Red%20Switches%20Kumara%20Redragon-600x600.png'),
(69, 'Audífonos Sony WH-CH510', 'Bluetooth, batería de larga duración.', 29.99, 11, 'https://www.sony.es/image/b789488955522f13ffb4778bd08465c6?fmt=pjpeg&bgcolor=FFFFFF&bgc=FFFFFF&wid=2515&hei=1320'),
(70, 'Alfombrilla gamer XL', 'Superficie extendida.', 9.99, 11, 'https://storage.googleapis.com/catalog-pictures-carrefour-es/catalog/pictures/hd_510x_/8434847061559_1.jpg'),
(71, 'Webcam Full HD', 'Videollamadas en alta definición.', 24.99, 11, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/214739381/webcam-usb-full-hd.jpg'),
(72, 'Hub USB 4 puertos', 'Expansor de puertos USB.', 12.99, 11, 'https://www.multimax.net/cdn/shop/products/ACH154_ACH124_MAIN3-184746_1024x1024_0cff12df-5a97-4216-8faf-5697fb403e04.png?v=1731703224'),
(73, 'Soporte para laptop', 'Ajustable, aluminio.', 19.99, 11, 'https://movicenter.com.pa/wp-content/uploads/2022/09/H1131eb7d8d94496a8bc486efe871f6bbH.jpg_640x640Q90.jpg_.webp'),
(74, 'Micrófono de escritorio', 'Ideal para streaming.', 17.99, 11, 'https://m.media-amazon.com/images/I/71Tdt5CFOuL.jpg'),
(75, 'Cargador portátil 10000mAh', 'Batería externa para dispositivos.', 21.99, 11, 'https://i0.wp.com/rlrbuy.com/wp-content/uploads/2024/11/YOBON-Power-Bank-de-10000-mAh-Cargador-Portatil-Ultradelgado-con-2-Salidas-USB-y-USB-C-2.png?fit=1080%2C1080&ssl=1'),
(76, 'Funda para teclado', 'Protección contra polvo y líquidos.', 5.99, 11, 'https://storage.googleapis.com/catalog-pictures-carrefour-es/catalog/pictures/hd_510x_/8436532168314_1.jpg'),
(77, 'Proyector Epson X05+', '3300 lúmenes, HDMI.', 349.99, 12, 'https://mediaserver.goepson.com/ImConvServlet/imconv/6f19424c57db9d974123026e29b198e1dc6b23a0/1200Wx1200H?use=banner&hybrisId=B2C&assetDescr=X05_690x460_4'),
(78, 'Proyector BenQ MS550', '3600 lúmenes, SVGA.', 299.99, 12, 'https://adm.premium-soft.com/empresas/sb_16411/imagenes/BENQ%20MW550%20(2)_1_11zon.jpg'),
(79, 'Proyector ViewSonic PA503S', '3800 lúmenes, SVGA.', 319.99, 12, 'https://cdn.panacompu.com/cdn-img/pv/viewsonic-pa503s-preview.jpg'),
(80, 'Pantalla de proyección 100\"', 'Portátil, fácil de instalar.', 59.99, 12, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/201604c1c/pantalla-para-proyector-automatica-de-100.jpg'),
(81, 'Soporte universal para proyector', 'Ajustable, techo/pared.', 24.99, 12, 'https://m.media-amazon.com/images/I/51cQ5rjMTLL.jpg'),
(82, 'Cable HDMI 5m', 'Para conexión de proyector.', 9.99, 12, 'https://lcdtcorp.com/cdn/shop/products/7917CV-HDMI5M_0dc61534-2ce1-4163-a936-4c3cb90754b5.jpg?v=1560983000'),
(83, 'Control remoto universal', 'Compatible con varios proyectores.', 12.99, 12, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/20400e5a2/control-remoto-universal-4-en-1.jpg'),
(84, 'Proyector portátil YG300', 'Mini, USB/HDMI.', 49.99, 12, 'https://bannerlandpty.com/wp-content/uploads/2024/05/mini_proyector_yg300_01_v2_negro_l.jpg'),
(85, 'Lámpara de repuesto para proyector', 'Compatible con varios modelos.', 39.99, 12, 'https://fscompras.com/wp-content/uploads/2023/03/71S7kUlPEHL._AC_SX522_.jpg'),
(86, 'Proyector LG PH550', 'Portátil, batería integrada.', 399.99, 12, 'https://www.lg.com/content/dam/channel/wcms/pa/images/proyectores/ph550/gallery/large01.jpg'),
(87, 'Cámara IP WiFi', 'Vigilancia remota desde smartphone.', 29.99, 13, 'https://selesapanama.com/market/wp-content/uploads/2021/01/SMART_IP_CAMERA_QUICK_JX_IPC02W.png'),
(88, 'Kit de cámaras CCTV', '4 cámaras, DVR incluido.', 199.99, 13, 'https://carbonestore.com/cdn/shop/files/55__1_ELT0175.13.jpg?v=1728595522'),
(89, 'Sensor de movimiento', 'Alarma para puertas y ventanas.', 14.99, 13, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/181559fa7/sensor-de-movimiento-pir-para-intemperie.jpg'),
(90, 'Videoportero digital', 'Pantalla a color, intercomunicador.', 89.99, 13, 'https://www.ventasdeseguridad.com/images/stories/VDS/users/amejia/hikvision.png'),
(91, 'Alarma inalámbrica', 'Sistema de seguridad para hogar.', 59.99, 13, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/21189e711/sistema-de-seguridad-wi-fi-con-alarma-6-sensores-y-2-controles-remoto.jpg'),
(92, 'Cerradura inteligente', 'Control desde app móvil.', 119.99, 13, 'https://selesapanama.com/market/wp-content/uploads/2021/01/image-738x738.png'),
(93, 'Cámara domo PTZ', 'Rotación y zoom motorizado.', 79.99, 13, 'https://dahuacamaras.com/admin/imagenes/S6Y7L8N768DH-SD59430IN-HC-S2.jpg'),
(94, 'Sirena de alarma', 'Alta potencia sonora.', 19.99, 13, 'https://m.media-amazon.com/images/I/61a-keiu34L.jpg'),
(95, 'Kit de sensores magnéticos', 'Para puertas y ventanas.', 12.99, 13, 'https://http2.mlstatic.com/D_NQ_NP_954774-MLM82272346915_022025-O-kit-8-sensores-magneticos-puerta-ventana-inalambrico-433mhz.webp'),
(96, 'Cámara espía USB', 'Discreta, grabación continua.', 24.99, 13, 'https://m.media-amazon.com/images/I/51HBayA3aaL.jpg'),
(97, 'Router TP-Link Archer C6', 'WiFi AC1200, 5GHz.', 39.99, 14, 'https://cdn.panacompu.com/cdn-img/pv/archerc6-side-view.jpg'),
(98, 'Switch de red 8 puertos', 'Gigabit Ethernet.', 29.99, 14, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/18766139c/switch-gigabit-ethernet-de-8-puertos.jpg'),
(99, 'Cable de red Cat6 10m', 'Alta velocidad, blindado.', 8.99, 14, 'https://movicenter.com.pa/wp-content/uploads/2022/04/pni-cable-red-rj45-utp-cat6e-15-m-1.jpg'),
(100, 'Adaptador USB WiFi', 'Conexión inalámbrica para PC.', 12.99, 14, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/20426b3ed/nano-adaptador-usb-wi-fi-doble-banda-2-4-y-5-ghz.jpg'),
(101, 'Antena WiFi de alta ganancia', 'Mejora la señal inalámbrica.', 9.99, 14, 'https://m.media-amazon.com/images/I/51933iXbkgL._AC_UF1000,1000_QL80_.jpg'),
(102, 'Módem ADSL2+', 'Conexión a internet estable.', 24.99, 14, 'https://www.trendnet.com/images/products/photos/TEW-635BRM_v2/TEW-635BRM_v2_d01_2.webp'),
(103, 'Patch panel 24 puertos', 'Organización de cableado.', 34.99, 14, 'https://adm.premium-soft.com/empresas/sb_44817/imagenes/art_PP2002.webp'),
(104, 'Repetidor WiFi', 'Amplía la cobertura inalámbrica.', 19.99, 14, 'https://www.steren.com.pa/media/catalog/product/cache/0236bbabe616ddcff749ccbc14f38bf2/image/22434b5b9/repetidor-router-wi-fi-300-mbps-2-4-ghz-hasta-30-m-de-cobertura.jpg'),
(105, 'Conector RJ45 blindado', 'Protección contra interferencias.', 1.49, 14, 'https://adm.premium-soft.com/empresas/sb_44817/imagenes/art_CN1006.webp'),
(106, 'Tester de red', 'Verifica continuidad y conexiones.', 14.99, 14, 'https://www.pce-iberica.es/medidor-detalles-tecnicos/images/tester-lan-pce-lt-2-500.jpg'),
(117, 'Computadora DELL OPTIPLEX 7020 (Micro) MFF', 'i7-14700T, 16GB DRR5, 512GB SSD, Windows 11 Pro, Es\r\nMarca: DELL\r\nModelo: 39YVT', 1187.99, 5, 'https://img.ptytec.com/images/product/5163941750267309.jpg'),
(118, 'Computadora DELL OPTIPLEX 7020 SFF', 'i5-14500, 8GB DRR5, 512GB SSD, Windows 11 Pro, Es\r\nMarca: DELL\r\nModelo: WJ8W7', 894.99, 5, 'https://img.ptytec.com/images/product/9136871744816536.jpg'),
(119, 'Computadora Lenovo ThinkCentre Neo 50Q G4', 'MFF, i5-13420H, 16GB DDR4, 1TB SSD, Windows 11 Pro, In', 879.99, 5, 'https://img.ptytec.com/images/product/1298631719006855.jpg'),
(120, 'Computadora HP ProDesk 400 G7 SFF', 'I7-10700, 8GB DDR4, 512GB SSD, Windows 10 Pro\r\nMarca: HP\r\nModelo: 3V2W7LT#ABM', 899.99, 5, 'https://img.ptytec.com/images/product/4195261740599776.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `NombreUsuario` varchar(50) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `Rol` enum('Admin','Consulta') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`NombreUsuario`, `Contrasena`, `Rol`) VALUES
('Administrador', 'admin', 'Admin'),
('Consulta', 'consulta', 'Consulta');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `ID_categorias` (`ID_categorias`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`NombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`ID_categorias`) REFERENCES `categorias` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
