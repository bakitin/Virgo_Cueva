// Catálogo de productos de La Virgo Cueva
// category: teclados | mouses | audio | monitores | sillas | gabinetes | gpu | procesadores
const PRODUCTS = [

  // ===================== TECLADOS =====================
  {
    id: 'acira',
    category: 'teclados',
    brand: 'Acira',
    name: 'Teclado Mecánico Acira',
    image: '/images/teclados/ACIRA_1.webp',
    price: 198900,
    shortDesc: 'Teclado mecánico full size con retroiluminación RGB.',
    description: 'Teclado mecánico de tamaño completo pensado para el día a día gamer: switches mecánicos, RGB por tecla y una construcción sólida a un precio accesible. Buena puerta de entrada al mundo mecánico sin gastar de más.',
    specs: ['Switches mecánicos', 'Retroiluminación RGB por tecla', 'Formato full size (104 teclas)', 'Conexión USB con cable']
  },
  {
    id: 'blackwidow-v4-tkl',
    category: 'teclados',
    brand: 'Razer',
    name: 'Razer BlackWidow V4 TKL',
    image: '/images/teclados/AZER_TKL_BLACWIDOW_V4_1.webp',
    price: 574900,
    badge: 'Nuevo',
    featured: true,
    shortDesc: 'Mecánico tenkeyless, sin la sección numérica para más espacio de mouse.',
    description: 'Versión tenkeyless del BlackWidow V4, pensado para quienes quieren más recorrido para el mouse sin sacrificar la sensación mecánica clásica de Razer. Ideal para escritorios chicos o para jugar en modo competitivo.',
    specs: ['Switches mecánicos Razer (clicky/verde)', 'Formato TKL (sin teclado numérico)', 'Chroma RGB', 'Reposamuñecas magnético incluido', 'Teclas multimedia dedicadas']
  },
  {
    id: 'blackwidow-v4-x-pikachu',
    category: 'teclados',
    brand: 'Razer',
    name: 'Razer BlackWidow V4 X — Edición Pokémon (Pikachu)',
    image: '/images/teclados/BLACKWIDOWV4X_PIKA_RAZER_1.webp',
    price: 706900,
    badge: 'Edición limitada',
    shortDesc: 'Edición especial Pokémon con detalles de Pikachu y Chroma RGB.',
    description: 'La colaboración de Razer con Pokémon en formato teclado: mismo BlackWidow V4 X de siempre, pero con acabados temáticos de Pikachu y una caja de colección. Para fans del pixel y del clic mecánico por igual.',
    specs: ['Switches mecánicos Razer verdes (clicky)', '6 teclas macro dedicadas', 'Chroma RGB', 'Keycaps doubleshot ABS', 'Edición coleccionable Pokémon']
  },
  {
    id: 'ornata-v3',
    category: 'teclados',
    brand: 'Razer',
    name: 'Razer Ornata V3',
    image: '/images/teclados/ORNATAVA_V3_1.webp',
    price: 330900,
    oldPrice: 375900,
    shortDesc: 'Híbrido mecha-membrana, low profile y silencioso.',
    description: 'Un punto medio entre membrana y mecánico: switches mecha-membrana que dan el clic táctil de un mecánico con la pisada suave de una membrana. Perfil bajo, cómodo para escribir todo el día y jugar en la noche.',
    specs: ['Switches mecha-membrana', 'Perfil bajo (low-profile)', '10 zonas de Chroma RGB', 'Resistente a salpicaduras', 'Reposamuñecas magnético incluido']
  },
  {
    id: 'g512-x',
    category: 'teclados',
    brand: 'Logitech G',
    name: 'Logitech G512 X',
    image: '/images/teclados/TECLADO_G512X_1.webp',
    price: 750900,
    badge: 'Nuevo',
    shortDesc: 'Teclado híbrido con switches analógicos TMR, ajustables por tecla.',
    description: 'La nueva generación de Logitech: 39 switches con sensor TMR que permiten ajustar la profundidad de activación de cada tecla, Rapid Trigger y doble acción por tecla. Se puede tunear a un nivel que antes solo veías en teclados boutique.',
    specs: ['Sensor TMR (analógico + mecánico)', 'Actuación ajustable de 0.1mm a 4.0mm', 'Rapid Trigger', 'Polling rate de 8000Hz', 'Formato 75%']
  },

  // ===================== MOUSES =====================
  {
    id: 'sabre-v2-pro',
    category: 'mouses',
    brand: 'Corsair',
    name: 'Corsair Sabre V2 Pro',
    image: '/images/mouses/GAMER_SABRE_V2_1.webp',
    price: 397900,
    shortDesc: 'Mouse inalámbrico ultraligero de 36g pensado para FPS competitivo.',
    description: 'Con apenas 36 gramos y sensor de 33.000 DPI, el Sabre V2 Pro está hecho para jugadores de FPS que necesitan flicks rápidos y precisos sin cansar la muñeca. Switches mecánicos calibrados y hasta 70 horas de batería.',
    specs: ['Sensor óptico 33.000 DPI', 'Peso 36g', 'Inalámbrico 2.4GHz', 'Hasta 70 horas de batería', 'Switches mecánicos (100M clics)']
  },
  {
    id: 'pulsefire-haste-2',
    category: 'mouses',
    brand: 'HyperX',
    name: 'HyperX Pulsefire Haste 2',
    image: '/images/mouses/HASTE_2_1.webp',
    price: 242900,
    shortDesc: 'Mouse inalámbrico ligero con carcasa perforada para mejor agarre.',
    description: 'La segunda generación del Haste mejora sensor, batería y la sensación en la mano, manteniendo el diseño perforado que lo hizo popular entre jugadores competitivos que buscan un mouse liviano sin gastar de más.',
    specs: ['Diseño ultraligero perforado', 'Inalámbrico 2.4GHz', 'Batería de larga duración', 'Pies de PTFE de fábrica']
  },
  {
    id: 'g305-lightspeed',
    category: 'mouses',
    brand: 'Logitech G',
    name: 'Logitech G305 Lightspeed',
    image: '/images/mouses/MOUSE_305_1.webp',
    price: 154900,
    oldPrice: 176900,
    shortDesc: 'El clásico inalámbrico confiable, ahora en oferta.',
    description: 'Un mouse que lleva años siendo la recomendación segura para quien recién arma su setup: inalámbrico de verdad (sin lag perceptible), liviano y con una batería que dura meses con una sola pila AA.',
    specs: ['Sensor HERO 12K DPI', 'Tecnología LIGHTSPEED', 'Hasta 250 horas de batería (1 pila AA)', '6 botones programables']
  },
  {
    id: 'g502-x-lightspeed',
    category: 'mouses',
    brand: 'Logitech G',
    name: 'Logitech G502 X Lightspeed',
    image: '/images/mouses/MOUSE_G502XLIGHTSPEED_1.webp',
    price: 574900,
    badge: 'Nuevo',
    featured: true,
    shortDesc: 'El G502 de siempre, ahora inalámbrico y con switches híbridos LIGHTFORCE.',
    description: 'El mouse más querido de Logitech vuelve en versión inalámbrica con switches LIGHTFORCE (mezcla de mecánico y óptico) que responden más rápido y duran más. Trece botones programables para quienes quieren todo a mano.',
    specs: ['Sensor HERO 25K DPI', '13 botones programables', 'Switches híbridos LIGHTFORCE', 'Compatible con carga inalámbrica POWERPLAY', 'Peso 102g']
  },
  {
    id: 'viper-v3-hyperspeed',
    category: 'mouses',
    brand: 'Razer',
    name: 'Razer Viper V3 HyperSpeed',
    image: '/images/mouses/VIPER_V3_HYPERSPEED_1.webp',
    price: 286900,
    oldPrice: 330900,
    shortDesc: 'Ultraliviano, con hasta 280 horas de batería. El favorito para FPS.',
    description: 'Con 59 gramos de peso y sensor Focus Pro 30K, el Viper V3 HyperSpeed se hizo un nombre entre jugadores de FPS competitivo que priorizan reacción sobre todo lo demás. La batería dura tanto que te vas a olvidar de cargarlo.',
    specs: ['Sensor Focus Pro 30K DPI', 'Peso 59g (82g con pila)', 'Hasta 280 horas de batería', '8 botones programables', 'Switches mecánicos (60M clics)']
  },

  // ===================== AUDIO =====================
  {
    id: 'astro-a20-x',
    category: 'audio',
    brand: 'Astro',
    name: 'Astro A20 X Wireless',
    image: '/images/audio/A20_X_BLACK_1.webp',
    price: 750900,
    shortDesc: 'Inalámbricos, conectan a dos dispositivos a la vez.',
    description: 'Pensados para quien juega en más de una plataforma: el A20 X se conecta simultáneamente a PC y consola gracias a su base PLAYSYNC. Livianos, cómodos para sesiones largas y con hasta 90 horas de batería.',
    specs: ['Drivers de 40mm', 'Conexión dual 2.4GHz + Bluetooth 5.3', 'Hasta 90 horas de batería', 'Micrófono desmontable', 'RGB personalizable']
  },
  {
    id: 'barracuda-x-quartz',
    category: 'audio',
    brand: 'Razer',
    name: 'Razer Barracuda X — Quartz',
    image: '/images/audio/BARRACUDA_X_QUARTZ_1.webp',
    price: 419900,
    oldPrice: 485900,
    shortDesc: 'Inalámbricos multiplataforma en un tono rosa quartz.',
    description: 'Livianos, versátiles y sin cables de más: el Barracuda X se conecta por 2.4GHz o Bluetooth a PC, consola o celular. El color Quartz le suma un toque distinto a un setup que no quiere ser todo negro.',
    specs: ['Drivers Razer TriForce de 40mm', 'Conexión 2.4GHz y Bluetooth', 'Hasta 20 horas de batería', 'Micrófono desmontable HyperClear']
  },
  {
    id: 'blackshark-v3-ps',
    category: 'audio',
    brand: 'Razer',
    name: 'Razer BlackShark V3 — Edición PlayStation',
    image: '/images/audio/BLACKSHARK_V3_PS_1.webp',
    price: 618900,
    badge: 'Nuevo',
    shortDesc: 'Headset esports certificado para PS5, también funciona en PC.',
    description: 'La línea BlackShark está pensada para esports: latencia inalámbrica bajísima y drivers TriForce Titanium de segunda generación. Esta edición trae la estética oficial de PlayStation sin perder rendimiento competitivo.',
    specs: ['Drivers TriForce Titanium 50mm Gen-2', 'Latencia inalámbrica desde 10ms', 'Micrófono HyperClear Super WideBand', 'Conexión 2.4GHz y Bluetooth']
  },
  {
    id: 'hs80-wireless',
    category: 'audio',
    brand: 'Corsair',
    name: 'Corsair HS80 RGB Wireless',
    image: '/images/audio/DIADEMA_HS80_W_1.webp',
    price: 618900,
    badge: 'Nuevo',
    featured: true,
    shortDesc: 'Sonido espacial Dolby Atmos y micrófono de estudio desmontable.',
    description: 'Uno de los headsets inalámbricos mejor evaluados de Corsair: audio espacial Dolby Atmos, memory foam en las orejeras y un micrófono de calidad broadcast que se puede sacar cuando no lo necesitas.',
    specs: ['Dolby Atmos para auriculares', 'Micrófono broadcast desmontable', 'Hasta 20 horas de batería', 'Orejeras de memory foam', 'RGB en los ear cups']
  },
  {
    id: 'kraken-kitty-v3-x',
    category: 'audio',
    brand: 'Razer',
    name: 'Razer Kraken Kitty V3 X',
    image: '/images/audio/DIADEMA_KITTY_V3_X_1.webp',
    price: 242900,
    shortDesc: 'El headset con orejas de gato, ahora más liviano.',
    description: 'El clásico diseño kitty de Razer en su versión con cable: liviano, con sonido 7.1 virtual y las orejitas RGB que lo hicieron famoso en streams. Ideal para quien quiere destacar en cámara sin gastar en la versión wireless.',
    specs: ['Drivers TriForce de 40mm', 'Sonido envolvente 7.1', 'Orejas de gato con RGB', 'Micrófono cardioide', 'Peso 270g']
  },

  // ===================== MONITORES =====================
  {
    id: 'lg-ultragear-27g523b',
    category: 'monitores',
    brand: 'LG',
    name: 'LG UltraGear 27G523B-B',
    image: '/images/monitores/27G523B-B_1.png',
    price: 706900,
    shortDesc: '27" Full HD IPS a 200Hz, la puerta de entrada al gaming competitivo.',
    description: 'Un monitor pensado para dar el salto de 60Hz a algo mucho más fluido sin gastar en un panel 4K. Panel IPS con buen color, 200Hz de refresco y compatibilidad con G-Sync y FreeSync Premium.',
    specs: ['27" Full HD (1920x1080) IPS', '200Hz / 1ms', 'NVIDIA G-Sync Compatible y AMD FreeSync Premium', 'HDR10', 'HDMI + DisplayPort']
  },
  {
    id: 'asus-rog-pg34wcdm',
    category: 'monitores',
    brand: 'ASUS ROG',
    name: 'ASUS ROG Swift OLED PG34WCDM',
    image: '/images/monitores/ASUS_ROG_OLED_34_PG34WCDN_.png',
    price: 4198900,
    badge: 'Premium',
    shortDesc: 'Ultrawide OLED de 34" a 240Hz. La gama alta de verdad.',
    description: 'Panel OLED curvo de 34 pulgadas con negros absolutos, 240Hz de refresco y 0.03ms de respuesta. Pensado para quien quiere lo mejor del mercado y no está dispuesto a hacer concesiones.',
    specs: ['34" WQHD (3440x1440) OLED curvo', '240Hz / 0.03ms', 'USB-C 90W con KVM integrado', 'NVIDIA G-Sync Compatible', 'Brillo pico de 1300 nits']
  },
  {
    id: 'asus-tuf-vg34wq5a',
    category: 'monitores',
    brand: 'ASUS TUF',
    name: 'ASUS TUF Gaming VG34WQ5A',
    image: '/images/monitores/MONITOR_ASUS_TUF_VG34WQ5A_1.png',
    price: 1855900,
    shortDesc: 'Ultrawide curvo de 34" con modo dual 720p a 400Hz.',
    description: 'Un ultrawide pensado para dos mundos: juega en WQHD a 200Hz para inmersión, o cambia con un botón a 720p 400Hz cuando lo que importa es la velocidad pura en shooters competitivos.',
    specs: ['34" WQHD (3440x1440) curvo 1500R', '200Hz (modo dual hasta 400Hz en 720p)', 'AMD FreeSync Premium', 'DisplayHDR 400', '95% DCI-P3']
  },
  {
    id: 'asus-proart-pa27jcv',
    category: 'monitores',
    brand: 'ASUS ProArt',
    name: 'ASUS ProArt PA27JCV 5K',
    image: '/images/monitores/MONITOR_PA27JCV_5K_1.png',
    price: 3314900,
    shortDesc: 'Monitor 5K calibrado de fábrica, para diseño y edición.',
    description: 'No es un monitor gamer, es una herramienta de trabajo: densidad de pixeles altísima, Delta E menor a 2 calibrado de fábrica y cobertura de color que lo hace apto para diseño gráfico y edición de video profesional.',
    specs: ['27" 5K (5120x2880) IPS', 'Delta E <2 calibrado de fábrica', '100% sRGB / 99% DCI-P3', 'USB-C 96W con hub y KVM', 'VESA DisplayHDR 500']
  },
  {
    id: 'msi-mpg-321urx',
    category: 'monitores',
    brand: 'MSI',
    name: 'MSI MPG 321URX QD-OLED',
    image: '/images/monitores/MSI_MPG_321URXW_QD-OLED_1.jpg',
    price: 3535900,
    badge: 'Premium',
    shortDesc: '32" 4K QD-OLED a 240Hz, para los que no perdonan nada.',
    description: 'Panel Quantum Dot OLED de 32 pulgadas en resolución 4K corriendo a 240Hz con 0.03ms de respuesta. Pantalla plana (no curva) pensada tanto para jugar como para trabajar con precisión de color.',
    specs: ['31.5" 4K UHD (3840x2160) QD-OLED', '240Hz / 0.03ms', 'VESA DisplayHDR True Black 400', 'USB-C 90W', '99% DCI-P3']
  },

  // ===================== SILLAS =====================
  {
    id: 'razer-iskur-v2-x-newgen',
    category: 'sillas',
    brand: 'Razer',
    name: 'Razer Iskur V2 X NewGen — Quartz',
    image: '/images/sillas/ISKUR_V2_X_NEEWGEN_QUARTZ_2.png',
    price: 1458900,
    badge: 'Nuevo',
    shortDesc: 'Soporte lumbar integrado de fábrica, en un tono quartz.',
    description: 'La versión accesible del Iskur, pero sin sacrificar lo esencial: soporte lumbar construido en el respaldo (no un cojín aparte), asiento ancho y reclinado de 152°. Pensada para sesiones largas frente al PC.',
    specs: ['Soporte lumbar integrado', 'Reclinado hasta 152°', 'Apoyabrazos 2D', 'Para usuarios de 160 a 190cm', 'Carga máxima 136kg']
  },
  {
    id: 'xpg-nexus-roja',
    category: 'sillas',
    brand: 'XPG',
    name: 'XPG Nexus — Roja',
    image: '/images/sillas/Silla-Gamer-XPG-NEXUS-Roja.jpg',
    price: 1060900,
    shortDesc: 'Tela repelente al agua y soporte lumbar en la curvatura del respaldo.',
    description: 'XPG entra al mundo de las sillas gamer con un modelo directo: soporte lumbar integrado en la curva del respaldo, tela resistente al agua y un reclinado amplio para las maratones de juego.',
    specs: ['Soporte lumbar integrado en el respaldo', 'Tela repelente al agua', 'Apoyabrazos 2D ajustables', 'Reclinado de 90° a 155°']
  },
  {
    id: 'silla-t3-charcoal',
    category: 'sillas',
    brand: 'T3',
    name: 'Silla Gamer T3 — Charcoal Grey',
    image: '/images/sillas/T3_CHARCOAL_GREY_1.png',
    price: 795900,
    shortDesc: 'Opción de entrada, cómoda para el día a día de estudio o trabajo.',
    description: 'Una silla gamer sin lujos innecesarios: estructura firme, tapiz resistente y ajustes básicos de altura y reclinado. La opción para quien recién arma su primer escritorio y no quiere gastar de más.',
    specs: ['Estructura de acero reforzada', 'Ajuste de altura a gas', 'Reclinado ajustable', 'Apoyabrazos fijos acolchados']
  },
  {
    id: 'corsair-tc100-relaxed',
    category: 'sillas',
    brand: 'Corsair',
    name: 'Corsair TC100 Relaxed — Negra',
    image: '/images/sillas/TC100_POLI_NEGRA_10.jpg',
    price: 1016900,
    oldPrice: 1148900,
    shortDesc: 'Diseño relajado tipo sillón, tapiz de PU negro.',
    description: 'Corsair se sale del molde "bucket seat" clásico con la línea TC100: un diseño más ancho y relajado, pensado para quienes pasan tantas horas trabajando como jugando y quieren algo cómodo antes que agresivo.',
    specs: ['Tapiz de cuero PU', 'Asiento ancho estilo relajado', 'Soporte lumbar ajustable', 'Apoyabrazos 4D']
  },
  {
    id: 'corsair-tc500-luxe-shadow',
    category: 'sillas',
    brand: 'Corsair',
    name: 'Corsair TC500 LUXE — Shadow',
    image: '/images/sillas/TC500LUXE_SHADOW_1.jpg',
    price: 2076900,
    badge: 'Premium',
    shortDesc: 'La silla tope de línea de Corsair, con cojín cervical magnético.',
    description: 'Asiento plano y ancho en vez del bucket seat tradicional, pensado puramente en comodidad: soporte lumbar de cuatro vías, apoyabrazos Omni-Flex y un cojín cervical magnético que se ajusta en segundos.',
    specs: ['Soporte lumbar ajustable en 4 direcciones', 'Apoyabrazos Omni-Flex', 'Cojín cervical magnético desmontable', 'Estructura de acero, carga máx. 120kg', 'Garantía Corsair de 2 años']
  },

  // ===================== GABINETES =====================
  {
    id: 'view-380-tg-black',
    category: 'gabinetes',
    brand: 'Thermaltake',
    name: 'Thermaltake View 380 TG ARGB — Black',
    image: '/images/gabinetes/380TG_BLACK.webp',
    price: 286900,
    shortDesc: 'Gabinete de doble cámara con panel de vidrio templado.',
    description: 'Diseño de doble cámara para separar la fuente y el cableado de la zona de componentes, con panel de vidrio templado al frente y al costado para lucir el armado completo.',
    specs: ['4x ventiladores ARGB de 120mm incluidos', 'Doble cámara (dual chamber)', 'Soporta radiador de 360mm arriba', 'Hasta 415mm de largo para GPU', 'Compatible con placas hidden-connector']
  },
  {
    id: 'view-380-tg-green',
    category: 'gabinetes',
    brand: 'Thermaltake',
    name: 'Thermaltake View 380 TG ARGB — Matcha Green',
    image: '/images/gabinetes/380TG_GREEN.webp',
    price: 419900,
    shortDesc: 'El mismo 380 TG, en un verde matcha que no se ve en cualquier setup.',
    description: 'Mismo gabinete de doble cámara y panel de vidrio templado, en un color que le da personalidad a un build sin recurrir al negro o blanco de siempre.',
    specs: ['4x ventiladores ARGB de 120mm incluidos', 'Doble cámara (dual chamber)', 'Soporta radiador de 360mm arriba', 'Panel frontal y lateral de vidrio templado']
  },
  {
    id: 'view-380-ws-white',
    category: 'gabinetes',
    brand: 'Thermaltake',
    name: 'Thermaltake View 380 TG ARGB — Snow (White)',
    image: '/images/gabinetes/380WS_WHITE.webp',
    price: 419900,
    shortDesc: 'Versión blanca (Snow) para builds claros.',
    description: 'La versión Snow del View 380: interior y exterior en blanco para builds claros, con la misma estructura de doble cámara y vidrio templado del resto de la serie.',
    specs: ['4x ventiladores ARGB de 120mm incluidos', 'Interior y exterior en blanco', 'Doble cámara (dual chamber)', 'Panel frontal y lateral de vidrio templado']
  },
  {
    id: 'view-270-tg-black',
    category: 'gabinetes',
    brand: 'Thermaltake',
    name: 'Thermaltake View 270 TG ARGB — Black',
    image: '/images/gabinetes/CHASIS_THERMALTAKE_270_TG_BLACK_1.webp',
    price: 264900,
    shortDesc: 'Versión más compacta de la serie View, mismo vidrio templado.',
    description: 'Para quien quiere el estilo de la serie View sin ocupar tanto espacio en el escritorio: panel de vidrio templado, buen flujo de aire y compatibilidad con radiadores de hasta 360mm arriba.',
    specs: ['Ventilador ARGB de 140mm incluido', 'Soporta radiador de 360mm arriba', 'Panel de vidrio templado', 'Compatible con ATX, mATX, Mini-ITX']
  },
  {
    id: 'versa-h18-white',
    category: 'gabinetes',
    brand: 'Thermaltake',
    name: 'Thermaltake Versa H18 — White',
    image: '/images/gabinetes/CHASIS_TT_VERSA_H16_W_1.webp',
    price: 220900,
    shortDesc: 'Micro-ATX compacto, ideal para un segundo PC o un build chico.',
    description: 'Gabinete Micro-ATX pensado para builds compactos: panel de vidrio templado, buena compatibilidad con AIO y espacio suficiente para una GPU de tamaño medio-grande.',
    specs: ['Formato Micro-ATX', 'Panel lateral de vidrio templado', 'Soporta AIO de hasta 280mm al frente', 'GPU de hasta 350mm sin ventiladores frontales']
  },

  // ===================== GPU =====================
  {
    id: 'rtx-5070-ti-frieren',
    category: 'gpu',
    brand: 'MSI',
    name: 'MSI GeForce RTX 5070 Ti 16GB — Edición Frieren',
    image: '/images/gpu/5070_TI_FRIEREN_1.png',
    price: 3314900,
    badge: 'Edición limitada',
    featured: true,
    shortDesc: 'Edición especial de colección inspirada en el anime Frieren.',
    description: 'La misma potencia de la RTX 5070 Ti, en una edición de colección con arte inspirado en Frieren: Beyond Journey\'s End. Para quien quiere que su GPU también sea una pieza de exhibición.',
    specs: ['16GB GDDR7', '8.960 CUDA Cores', 'Bus de 256-bit / 896 GB/s', 'Edición de colección con caja temática', 'PCIe 5.0']
  },
  {
    id: 'palit-rtx-5070-white',
    category: 'gpu',
    brand: 'Palit',
    name: 'Palit GeForce RTX 5070 White OC 12GB',
    image: '/images/gpu/PALIT_5070_WHITE_12G_1.png',
    price: 2430900,
    shortDesc: 'Triple fan en blanco, para builds claros.',
    description: 'La RTX 5070 en una carcasa blanca pensada para integrarse en builds de tonos claros, con un sistema de triple ventilador que se banca juegos AAA y cargas de trabajo creativas sin problema.',
    specs: ['12GB GDDR7', '6.144 CUDA Cores', 'Bus de 192-bit / 672 GB/s', 'Triple ventilador', 'PCIe 5.0, HDMI 2.1b + 3x DisplayPort 2.1']
  },
  {
    id: 'asus-dual-rtx-5060ti',
    category: 'gpu',
    brand: 'ASUS',
    name: 'ASUS Dual GeForce RTX 5060 Ti 8GB OC',
    image: '/images/gpu/TARJETA_ASUS_DUAL_5060TI_8G_1.png',
    price: 1767900,
    shortDesc: 'El punto justo entre precio y rendimiento 1440p.',
    description: 'Formato de doble ventilador compacto (2.5 slots) con la tecnología Axial-tech de ASUS y 0dB Technology, que apaga los ventiladores por completo con cargas bajas. Buena opción para 1440p sin gastar en la gama alta.',
    specs: ['8GB GDDR7', '4608 CUDA Cores', 'Bus de 128-bit', 'Diseño de 2.5 slots, doble ventilador Axial-tech', '0dB Technology']
  },
  {
    id: 'asrock-rx-9060xt-challenger',
    category: 'gpu',
    brand: 'ASRock',
    name: 'ASRock Radeon RX 9060 XT Challenger 16GB OC',
    image: '/images/gpu/Tarjeta-ASRock-Radeon-RX-9060-XT-Challenger-16GB-OC.jpg',
    price: 1767900,
    oldPrice: 2032900,
    shortDesc: 'RDNA 4 con 16GB de VRAM, apuntando directo a 1440p.',
    description: 'La apuesta de AMD para 1440p con arquitectura RDNA 4: 16GB de memoria (útiles para texturas exigentes), doble ventilador con modo silencioso 0dB y buen precio frente a la competencia directa de NVIDIA.',
    specs: ['16GB GDDR6', 'Arquitectura RDNA 4 (32 compute units)', 'Bus de 128-bit / 20Gbps', 'Doble ventilador, 0dB silencioso', 'PCIe 5.0']
  },

  // ===================== PROCESADORES =====================
  {
    id: 'ryzen-7-5800xt',
    category: 'procesadores',
    brand: 'AMD',
    name: 'AMD Ryzen 7 5800XT',
    image: '/images/procesadores/AMD_RYZEN_7_5800XT_1.webp',
    price: 883900,
    shortDesc: 'El último refresco de AM4, para exprimir tu placa madre actual.',
    description: 'Pensado para quien ya tiene una placa AM4 y quiere el mejor procesador posible sin migrar de plataforma. Ocho núcleos Zen 3 a buena frecuencia, sin necesidad de cambiar memoria ni placa madre.',
    specs: ['8 núcleos / 16 hilos', 'Socket AM4', 'Arquitectura Zen 3', 'Compatible con placas B450/X470/B550/X570 (con actualización de BIOS)']
  },
  {
    id: 'intel-core-i7-14700k',
    category: 'procesadores',
    brand: 'Intel',
    name: 'Intel Core i7-14700K',
    image: '/images/procesadores/INTEL_CORE_I7_UNLOCKED_1.webp',
    price: 1679900,
    shortDesc: 'Desbloqueado para overclock, con núcleos de rendimiento y eficiencia.',
    description: 'Combina núcleos de rendimiento y de eficiencia para sacarle el jugo tanto a juegos como a tareas de productividad multi-hilo. Multiplicador desbloqueado para quienes les gusta ajustar el overclock.',
    specs: ['20 núcleos (8P + 12E) / 28 hilos', 'Multiplicador desbloqueado (K)', 'Socket LGA1700', 'Compatible con DDR4 y DDR5 (según placa)']
  },
  {
    id: 'ryzen-5-7600x3d',
    category: 'procesadores',
    brand: 'AMD',
    name: 'AMD Ryzen 5 7600X3D',
    image: '/images/procesadores/PROCESADOR_5_7600X3D.webp',
    price: 1237900,
    badge: 'Nuevo',
    shortDesc: 'El 3D V-Cache más accesible de AMD, pensado 100% para gaming.',
    description: 'Seis núcleos Zen 4 con 96MB de caché L3 gracias a la tecnología 3D V-Cache, que en juegos se traduce en más FPS estables que procesadores con más núcleos pero sin ese caché extra.',
    specs: ['6 núcleos / 12 hilos', '96MB de caché L3 (3D V-Cache)', 'Socket AM5', 'TDP de 65W', 'Compatible con A620, B650, X670']
  },
  {
    id: 'ryzen-7-7700x',
    category: 'procesadores',
    brand: 'AMD',
    name: 'AMD Ryzen 7 7700X',
    image: '/images/procesadores/PROCESADOR_7_77000_1.webp',
    price: 1458900,
    shortDesc: 'Ocho núcleos Zen 4 en socket AM5, listo para DDR5.',
    description: 'Un procesador parejo para gaming y trabajo: ocho núcleos Zen 4 en la plataforma AM5, con espacio para crecer a futuro con mejores placas y memoria DDR5 más rápida.',
    specs: ['8 núcleos / 16 hilos', 'Socket AM5 (DDR5)', 'Arquitectura Zen 4', 'Frecuencia boost alta de fábrica']
  },
];

function formatCOP(amount) {
  return '$' + Number(amount).toLocaleString('es-CO');
}

export { PRODUCTS, formatCOP };
