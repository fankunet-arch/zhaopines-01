-- =============================================================
-- 西华招聘 zhaopin.es — 地区种子数据（精简版 A）
-- 表：zhaopin_regions
-- 结构：level=1 大区(自治区)，level=2 市；parent_id 指向所属大区
-- 命名：大区用「中文 西语」；城市有通用中文名用「中文 西语」，否则用西语原名
-- 字符集：执行前确保连接为 utf8mb4
-- =============================================================
SET NAMES utf8mb4;

-- ---------- 顶层：17 自治区 + 2 自治市（level=1，显式 id 1–19） ----------
INSERT INTO zhaopin_regions (id, parent_id, name, level, sort, status) VALUES
(14, 0, '马德里大区 Comunidad de Madrid',      1, 1,  1),
(9,  0, '加泰罗尼亚 Cataluña',                  1, 2,  1),
(10, 0, '瓦伦西亚大区 Comunidad Valenciana',    1, 3,  1),
(1,  0, '安达卢西亚 Andalucía',                 1, 4,  1),
(17, 0, '巴斯克 País Vasco',                    1, 5,  1),
(12, 0, '加利西亚 Galicia',                     1, 6,  1),
(2,  0, '阿拉贡 Aragón',                        1, 7,  1),
(5,  0, '加那利群岛 Canarias',                  1, 8,  1),
(4,  0, '巴利阿里群岛 Islas Baleares',          1, 9,  1),
(8,  0, '卡斯蒂利亚-莱昂 Castilla y León',      1, 10, 1),
(7,  0, '卡斯蒂利亚-拉曼恰 Castilla-La Mancha', 1, 11, 1),
(15, 0, '穆尔西亚大区 Región de Murcia',        1, 12, 1),
(3,  0, '阿斯图里亚斯 Asturias',                1, 13, 1),
(6,  0, '坎塔布里亚 Cantabria',                 1, 14, 1),
(16, 0, '纳瓦拉 Navarra',                       1, 15, 1),
(13, 0, '拉里奥哈 La Rioja',                    1, 16, 1),
(11, 0, '埃斯特雷马杜拉 Extremadura',           1, 17, 1),
(18, 0, '休达 Ceuta',                           1, 18, 1),
(19, 0, '梅利利亚 Melilla',                     1, 19, 1);

-- ---------- 马德里大区(14) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(14, '马德里 Madrid',                 2, 1),
(14, 'Móstoles',                      2, 1),
(14, 'Alcalá de Henares',             2, 1),
(14, 'Fuenlabrada',                   2, 1),
(14, 'Leganés',                       2, 1),
(14, 'Getafe',                        2, 1),
(14, 'Alcorcón',                      2, 1),
(14, 'Torrejón de Ardoz',             2, 1),
(14, 'Parla',                         2, 1),
(14, 'Alcobendas',                    2, 1);

-- ---------- 加泰罗尼亚(9) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(9, '巴塞罗那 Barcelona',             2, 1),
(9, 'L''Hospitalet de Llobregat',     2, 1),
(9, 'Badalona',                       2, 1),
(9, 'Terrassa',                       2, 1),
(9, 'Sabadell',                       2, 1),
(9, 'Tarragona',                      2, 1),
(9, 'Girona',                         2, 1),
(9, 'Lleida',                         2, 1),
(9, 'Santa Coloma de Gramenet',       2, 1),
(9, 'Mataró',                         2, 1),
(9, 'Reus',                           2, 1);

-- ---------- 瓦伦西亚大区(10) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(10, '瓦伦西亚 Valencia',             2, 1),
(10, '阿利坎特 Alicante',             2, 1),
(10, 'Elche',                         2, 1),
(10, 'Castellón de la Plana',         2, 1),
(10, 'Torrevieja',                    2, 1),
(10, 'Benidorm',                      2, 1),
(10, 'Gandia',                        2, 1),
(10, 'Orihuela',                      2, 1);

-- ---------- 安达卢西亚(1) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(1, '塞维利亚 Sevilla',               2, 1),
(1, '马拉加 Málaga',                  2, 1),
(1, '格拉纳达 Granada',               2, 1),
(1, '科尔多瓦 Córdoba',               2, 1),
(1, 'Almería',                        2, 1),
(1, 'Cádiz',                          2, 1),
(1, 'Jaén',                           2, 1),
(1, 'Huelva',                         2, 1),
(1, 'Marbella',                       2, 1),
(1, 'Jerez de la Frontera',           2, 1),
(1, 'Algeciras',                      2, 1);

-- ---------- 巴斯克(17) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(17, '毕尔巴鄂 Bilbao',               2, 1),
(17, 'Vitoria-Gasteiz',               2, 1),
(17, '圣塞瓦斯蒂安 San Sebastián',    2, 1),
(17, 'Barakaldo',                     2, 1);

-- ---------- 加利西亚(12) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(12, '维戈 Vigo',                     2, 1),
(12, '拉科鲁尼亚 A Coruña',           2, 1),
(12, '圣地亚哥 Santiago de Compostela',2, 1),
(12, 'Pontevedra',                    2, 1),
(12, 'Lugo',                          2, 1),
(12, 'Ourense',                       2, 1),
(12, 'Ferrol',                        2, 1);

-- ---------- 阿拉贡(2) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(2, '萨拉戈萨 Zaragoza',              2, 1),
(2, 'Huesca',                         2, 1),
(2, 'Teruel',                         2, 1);

-- ---------- 加那利群岛(5) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(5, '拉斯帕尔马斯 Las Palmas de Gran Canaria', 2, 1),
(5, '圣克鲁斯 Santa Cruz de Tenerife',         2, 1),
(5, 'San Cristóbal de La Laguna',              2, 1),
(5, 'Arona',                                   2, 1);

-- ---------- 巴利阿里群岛(4) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(4, '帕尔马 Palma',                   2, 1),
(4, 'Ibiza',                          2, 1);

-- ---------- 卡斯蒂利亚-莱昂(8) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(8, '巴利亚多利德 Valladolid',        2, 1),
(8, 'León',                           2, 1),
(8, 'Burgos',                         2, 1),
(8, '萨拉曼卡 Salamanca',             2, 1),
(8, 'Segovia',                        2, 1),
(8, 'Ávila',                          2, 1),
(8, 'Palencia',                       2, 1),
(8, 'Soria',                          2, 1),
(8, 'Zamora',                         2, 1);

-- ---------- 卡斯蒂利亚-拉曼恰(7) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(7, '托莱多 Toledo',                  2, 1),
(7, 'Albacete',                       2, 1),
(7, 'Ciudad Real',                    2, 1),
(7, 'Cuenca',                         2, 1),
(7, 'Guadalajara',                    2, 1),
(7, 'Talavera de la Reina',           2, 1);

-- ---------- 穆尔西亚大区(15) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(15, '穆尔西亚 Murcia',               2, 1),
(15, 'Cartagena',                     2, 1),
(15, 'Lorca',                         2, 1),
(15, 'Molina de Segura',              2, 1);

-- ---------- 阿斯图里亚斯(3) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(3, '奥维耶多 Oviedo',                2, 1),
(3, '希洪 Gijón',                     2, 1),
(3, 'Avilés',                         2, 1);

-- ---------- 坎塔布里亚(6) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(6, '桑坦德 Santander',               2, 1),
(6, 'Torrelavega',                    2, 1);

-- ---------- 纳瓦拉(16) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(16, '潘普洛纳 Pamplona',             2, 1),
(16, 'Tudela',                        2, 1);

-- ---------- 拉里奥哈(13) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(13, 'Logroño',                       2, 1);

-- ---------- 埃斯特雷马杜拉(11) ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(11, 'Mérida',                        2, 1),
(11, 'Badajoz',                       2, 1),
(11, 'Cáceres',                       2, 1);

-- ---------- 休达(18) / 梅利利亚(19)：自治市，仅一个市级条目 ----------
INSERT INTO zhaopin_regions (parent_id, name, level, status) VALUES
(18, '休达 Ceuta',                    2, 1),
(19, '梅利利亚 Melilla',              2, 1);

-- =============================================================
-- 完成。共 19 个大区 + 约 90 个市。
-- 如需调整：城市增删直接改对应 INSERT；想全用西语或全用中文，改 name 即可。
-- =============================================================
