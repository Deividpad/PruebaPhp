CREATE DATABASE pruebadb;

CREATE TABLE `articulo` (
  `Id` int(11) NOT NULL,
  `CodigoArt` varchar(50) DEFAULT NULL,
  `NombreArt` varchar(100) DEFAULT NULL,
  `DescripcionArt` text,
  `CantidadArt` int(11) DEFAULT NULL,
  `PrecioArt` int(11) DEFAULT NULL,
  `ImagenArt` varchar(200) DEFAULT NULL,
  `EstadoArt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`Id`, `CodigoArt`, `NombreArt`, `DescripcionArt`, `CantidadArt`, `PrecioArt`, `ImagenArt`, `EstadoArt`) VALUES
(1, 'A001', 'Bafles', 'Descripcion del articulo 1', 170, 420000, 'A001-Bafles.jpg', 1),
(2, 'A002', 'Diademas', 'Descripcion de articulo 2', 490, 250000, 'A002-Diademas.jpg', 0),
(3, 'A003', 'Dinpensador', 'Descripcion del articulo 3', 300, 399000, 'A003-Dispensador.jpg', 1),
(4, 'A004', 'Reloj', 'Descripcion articulo 4', 788, 145000, 'A004-Reloj.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `usuario`, `contrasena`) VALUES
(1, 'admin', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;