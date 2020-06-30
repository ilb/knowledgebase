-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 25 2020 г., 10:47
-- Версия сервера: 5.6.43
-- Версия PHP: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `knowledgebase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `keyword`
--

CREATE TABLE `keyword` (
  `id_keyword` int(7) NOT NULL,
  `name_keyword` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `keyword`
--

INSERT INTO `keyword` (`id_keyword`, `name_keyword`) VALUES
(1, 'arhitektura_prilozenij'),
(2, 'princip__arhitektur_'),
(3, 'razdelenie_funkcij'),
(4, 'gruppirovanie_servisov'),
(5, 'povtornoe_ispol_zovanie_servisov'),
(6, 'tip__zavisimostej'),
(7, 'tip__vzaimodejstvij'),
(8, 'sloi_arhitektur_'),
(9, 'sloj_biznes-processov'),
(10, 'sloj_slabosvjzann_h_servisov'),
(11, 'princip__proektirovanij'),
(12, 'Code_review'),
(13, 'Definition'),
(14, 'Types_of_Code_Review'),
(15, 'Checklist'),
(16, 'kodirovanie'),
(17, 'kacestvo_koda'),
(18, 'dokumentirovanie'),
(19, 'izobretenie_koles'),
(20, 'testirovanie'),
(21, 'obucenie'),
(22, 'zaklycenie'),
(23, 'predmetno-orientirovannoe_proektirovanie'),
(24, 'opredelenie'),
(25, 'celi'),
(26, 'stoimost_'),
(27, 'princip__razrabotki'),
(28, 'cistaj_logika'),
(29, 'otnosenij'),
(30, 'otnosenie__jvljetsj___is_'),
(31, 'otnosenie__soderzit___has_'),
(32, 'otnosenie__ispol_zuet___uses_'),
(33, 'sloi_prilozenij'),
(34, 'sloj_predmetnoj_oblasti'),
(35, 'sloj_sluzb'),
(36, 'vnedrenie_zavisimostej'),
(37, 'rassirjemost_'),
(38, 'podklycaem_e_realizacii'),
(39, 'mezmodul_naj_svjz_'),
(40, 'testiruem_j_kod'),
(41, 'sablon_'),
(42, 'instrument__proektrovanij'),
(43, 'ICONIX'),
(44, 'opisite_funkcional_n_e_trebovanij_v_ssego_porjdka'),
(45, 'modelirovanie_predmetnoj_oblasti'),
(46, 'ispol_zujte_predmetnuy_oblast__kak_glossarij_proek'),
(47, 'modelirovanie_precedentov'),
(48, 'process_razrabotki_ICONIX'),
(49, 'vopros__interv_y'),
(50, 'baza_znanij'),
(51, 'biznes-sloj1'),
(52, 'kratkoe_opisanie_proekta'),
(53, 'doroznaj_karta'),
(54, 'zadaci_pol_zovatelj'),
(55, 'material_'),
(56, 'variant__ispol_zovanij'),
(57, 'biznes-pravila'),
(58, 'shem__b'),
(59, 'kriterii_priemki'),
(60, 'scenarij_prodaz'),
(61, 'tehniceskij_sloj1'),
(62, 'upravlenie_produktami'),
(63, 's_cego_nacinaetsj_produkt'),
(64, 'strategij_produkta'),
(65, 'analiz_dann_h'),
(66, 'prioritizacij_zadac'),
(67, 'zadaci_pol_zovatelej'),
(68, 'Job_To_Be_Done'),
(69, 'interv_y_pol_zovatelej'),
(70, 'cto_v__hotite_sdelat__'),
(71, 'kak_v__v_nastojsee_vremj_delaete_eto_'),
(72, 'kak_mozno_ulucsit__to__cto_v__delaete_'),
(73, 'proektirovanie_susnostej'),
(74, 'sostav_susnostej'),
(75, 'sostojnie_susnosti'),
(76, 'povedenie_susnostej'),
(77, 'otnosenij'),
(78, 'igra__susnosti_i_povedenie_'),
(79, 'modelirovanie'),
(80, 'metod__analiza_dann_h'),
(81, 'metriki'),
(82, 'harakteristiki_metriki'),
(83, 'relevantnost_'),
(84, 'izmerimost_'),
(85, 'dejstvennost_'),
(86, 'nadeznost_'),
(87, 'udobocitaemost_'),
(88, 'voronka_prodaz'),
(89, 'produktovaj_komanda'),
(90, 'formirovanie_komand'),
(91, 'avtonomnost__komand_'),
(92, 'menedzer_produkta'),
(93, 'dolznostn_e_objzannosti_menedzera_produkta'),
(94, 'menedzer_produkta_1__stazer_'),
(95, 'menedzer_produkta_1__nacinaysij_'),
(96, 'menedzer_produkta_2__vedusij_'),
(97, 'menedzer_produkta_3__lider_'),
(98, 'menedzer_produkta_3__'),
(99, 'ocenka_rezul_tatov_rabot_'),
(100, 'prinjtie_resenij'),
(101, 'analiz_dann_h'),
(102, 'kommunikacij'),
(103, 'obucenie_i_motivacij'),
(104, 'dolzen_li_menedzer_produkta_umet__programmirovat__'),
(105, 'dolzen_li_menedzer_produkta_ponimat__psihologiy__m'),
(106, 'i'),
(107, 'dolznostn_e_objzannosti'),
(108, 'inzener_1__stazer_'),
(109, 'inzener_1__nacinaysij_'),
(110, 'inzener_2__vedusij_'),
(111, 'inzener_2__vedusij+_'),
(112, 'inzener_3__lider_'),
(113, 'inzener_3__'),
(114, 'inzener_3__1'),
(115, 'arhitektor'),
(116, 'ocenka_rezul_tatov_rabot_1'),
(117, 'analitik_dann_h'),
(118, 'QA-inzener'),
(119, 'dolznostn_e_objzannosti1'),
(120, 'QA-inzener_1__'),
(121, 'QA-inzener_1__nacinaysij_'),
(122, 'QA-inzener_1__vedusij_'),
(123, 'QA-inzener1'),
(124, 'QA-inzener_3__lider_'),
(125, 'QA-inzener_3__'),
(126, 'ocenka_rezul_tatov_rabot_11'),
(127, 'stakeholders'),
(128, 'inzener-programmist'),
(129, 'menedzer_produkta'),
(130, 'Test_driven_design'),
(131, 'Definition'),
(132, 'Problems'),
(133, 'Nightmare_to_maintain__slow_to_develop'),
(134, 'Failing_to_meet_actual_need'),
(135, 'Solution'),
(136, 'Build_thing_right:_TDD'),
(137, 'TDD'),
(138, 'TEST_FIRST'),
(139, 'Build_right_t'),
(140, 'Close_collaboration'),
(141, 'Shared_language'),
(142, 'diagramm__precedentov'),
(143, 'element__diagramm_'),
(144, 'dejstvuysee_lico'),
(145, 'precedent'),
(146, 'svjz_');

-- --------------------------------------------------------

--
-- Структура таблицы `material`
--

CREATE TABLE `material` (
  `id_material` int(7) NOT NULL,
  `name_material` varchar(100) NOT NULL,
  `source` text NOT NULL,
  `type` enum('document','resource') NOT NULL DEFAULT 'resource'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material`
--

INSERT INTO `material` (`id_material`, `name_material`, `source`, `type`) VALUES
(1, 'examples/', 'https://ilb.github.io/devmethodology/examples/', 'document'),
(2, 'external/', 'https://ilb.github.io/devmethodology/external/', 'document'),
(3, 'interview/', 'https://ilb.github.io/devmethodology/interview/', 'document'),
(4, 'presentation/', 'https://ilb.github.io/devmethodology/presentation/', 'document'),
(5, 'architecture.xhtml', 'https://ilb.github.io/devmethodology/architecture.xhtml', 'document'),
(6, 'codereview_en.xhtml', 'https://ilb.github.io/devmethodology/codereview_en.xhtml', 'document'),
(7, 'coding.xhtml', 'https://ilb.github.io/devmethodology/coding.xhtml', 'document'),
(8, 'ddd.xhtml', 'https://ilb.github.io/devmethodology/ddd.xhtml', 'document'),
(9, 'iconix.xhtml', 'https://ilb.github.io/devmethodology/iconix.xhtml', 'document'),
(10, 'iconixdevelopmentprocess.xhtml', 'https://ilb.github.io/devmethodology/iconixdevelopmentprocess.xhtml', 'document'),
(11, 'interview.xhtml', 'https://ilb.github.io/devmethodology/interview.xhtml', 'document'),
(12, 'knowlegebase.xhtml', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml', 'document'),
(13, 'productmanagement.xhtml', 'https://ilb.github.io/devmethodology/productmanagement.xhtml', 'document'),
(14, 'productteam.xhtml', 'https://ilb.github.io/devmethodology/productteam.xhtml', 'document'),
(15, 'skills.xhtml', 'https://ilb.github.io/devmethodology/skills.xhtml', 'document'),
(16, 'tdd.xhtml', 'https://ilb.github.io/devmethodology/tdd.xhtml', 'document'),
(17, 'usecases.xhtml', 'https://ilb.github.io/devmethodology/usecases.xhtml', 'document'),
(18, 'architecture.xhtml#arhitektura_prilozenij', 'https://ilb.github.io/devmethodology/architecture.xhtml#arhitektura_prilozenij', 'resource'),
(19, 'architecture.xhtml#princip__arhitektur_', 'https://ilb.github.io/devmethodology/architecture.xhtml#princip__arhitektur_', 'resource'),
(20, 'architecture.xhtml#razdelenie_funkcij', 'https://ilb.github.io/devmethodology/architecture.xhtml#razdelenie_funkcij', 'resource'),
(21, 'architecture.xhtml#gruppirovanie_servisov', 'https://ilb.github.io/devmethodology/architecture.xhtml#gruppirovanie_servisov', 'resource'),
(22, 'architecture.xhtml#povtornoe_ispol_zovanie_servisov', 'https://ilb.github.io/devmethodology/architecture.xhtml#povtornoe_ispol_zovanie_servisov', 'resource'),
(23, 'architecture.xhtml#tip__zavisimostej', 'https://ilb.github.io/devmethodology/architecture.xhtml#tip__zavisimostej', 'resource'),
(24, 'architecture.xhtml#tip__vzaimodejstvij', 'https://ilb.github.io/devmethodology/architecture.xhtml#tip__vzaimodejstvij', 'resource'),
(25, 'architecture.xhtml#sloi_arhitektur_', 'https://ilb.github.io/devmethodology/architecture.xhtml#sloi_arhitektur_', 'resource'),
(26, 'architecture.xhtml#sloj_biznes-processov', 'https://ilb.github.io/devmethodology/architecture.xhtml#sloj_biznes-processov', 'resource'),
(27, 'architecture.xhtml#sloj_slabosvjzann_h_servisov', 'https://ilb.github.io/devmethodology/architecture.xhtml#sloj_slabosvjzann_h_servisov', 'resource'),
(28, 'architecture.xhtml#princip__proektirovanij', 'https://ilb.github.io/devmethodology/architecture.xhtml#princip__proektirovanij', 'resource'),
(29, 'codereview_en.xhtml#Code_review', 'https://ilb.github.io/devmethodology/codereview_en.xhtml#Code_review', 'resource'),
(30, 'codereview_en.xhtml#Definition', 'https://ilb.github.io/devmethodology/codereview_en.xhtml#Definition', 'resource'),
(31, 'codereview_en.xhtml#Types_of_Code_Review', 'https://ilb.github.io/devmethodology/codereview_en.xhtml#Types_of_Code_Review', 'resource'),
(32, 'codereview_en.xhtml#Checklist', 'https://ilb.github.io/devmethodology/codereview_en.xhtml#Checklist', 'resource'),
(33, 'coding.xhtml#kodirovanie', 'https://ilb.github.io/devmethodology/coding.xhtml#kodirovanie', 'resource'),
(34, 'coding.xhtml#kacestvo_koda', 'https://ilb.github.io/devmethodology/coding.xhtml#kacestvo_koda', 'resource'),
(35, 'coding.xhtml#dokumentirovanie', 'https://ilb.github.io/devmethodology/coding.xhtml#dokumentirovanie', 'resource'),
(36, 'coding.xhtml#izobretenie_koles', 'https://ilb.github.io/devmethodology/coding.xhtml#izobretenie_koles', 'resource'),
(37, 'coding.xhtml#testirovanie', 'https://ilb.github.io/devmethodology/coding.xhtml#testirovanie', 'resource'),
(38, 'coding.xhtml#obucenie', 'https://ilb.github.io/devmethodology/coding.xhtml#obucenie', 'resource'),
(39, 'coding.xhtml#zaklycenie', 'https://ilb.github.io/devmethodology/coding.xhtml#zaklycenie', 'resource'),
(40, 'ddd.xhtml#predmetno-orientirovannoe_proektirovanie', 'https://ilb.github.io/devmethodology/ddd.xhtml#predmetno-orientirovannoe_proektirovanie', 'resource'),
(41, 'ddd.xhtml#opredelenie', 'https://ilb.github.io/devmethodology/ddd.xhtml#opredelenie', 'resource'),
(42, 'ddd.xhtml#celi', 'https://ilb.github.io/devmethodology/ddd.xhtml#celi', 'resource'),
(43, 'ddd.xhtml#stoimost_', 'https://ilb.github.io/devmethodology/ddd.xhtml#stoimost_', 'resource'),
(44, 'ddd.xhtml#princip__razrabotki', 'https://ilb.github.io/devmethodology/ddd.xhtml#princip__razrabotki', 'resource'),
(45, 'ddd.xhtml#cistaj_logika', 'https://ilb.github.io/devmethodology/ddd.xhtml#cistaj_logika', 'resource'),
(46, 'ddd.xhtml#otnosenij', 'https://ilb.github.io/devmethodology/ddd.xhtml#otnosenij', 'resource'),
(47, 'ddd.xhtml#otnosenie__jvljetsj___is_', 'https://ilb.github.io/devmethodology/ddd.xhtml#otnosenie__jvljetsj___is_', 'resource'),
(48, 'ddd.xhtml#otnosenie__soderzit___has_', 'https://ilb.github.io/devmethodology/ddd.xhtml#otnosenie__soderzit___has_', 'resource'),
(49, 'ddd.xhtml#otnosenie__ispol_zuet___uses_', 'https://ilb.github.io/devmethodology/ddd.xhtml#otnosenie__ispol_zuet___uses_', 'resource'),
(50, 'ddd.xhtml#sloi_prilozenij', 'https://ilb.github.io/devmethodology/ddd.xhtml#sloi_prilozenij', 'resource'),
(51, 'ddd.xhtml#sloj_predmetnoj_oblasti', 'https://ilb.github.io/devmethodology/ddd.xhtml#sloj_predmetnoj_oblasti', 'resource'),
(52, 'ddd.xhtml#sloj_sluzb', 'https://ilb.github.io/devmethodology/ddd.xhtml#sloj_sluzb', 'resource'),
(53, 'ddd.xhtml#vnedrenie_zavisimostej', 'https://ilb.github.io/devmethodology/ddd.xhtml#vnedrenie_zavisimostej', 'resource'),
(54, 'ddd.xhtml#rassirjemost_', 'https://ilb.github.io/devmethodology/ddd.xhtml#rassirjemost_', 'resource'),
(55, 'ddd.xhtml#podklycaem_e_realizacii', 'https://ilb.github.io/devmethodology/ddd.xhtml#podklycaem_e_realizacii', 'resource'),
(56, 'ddd.xhtml#mezmodul_naj_svjz_', 'https://ilb.github.io/devmethodology/ddd.xhtml#mezmodul_naj_svjz_', 'resource'),
(57, 'ddd.xhtml#testiruem_j_kod', 'https://ilb.github.io/devmethodology/ddd.xhtml#testiruem_j_kod', 'resource'),
(58, 'ddd.xhtml#sablon_', 'https://ilb.github.io/devmethodology/ddd.xhtml#sablon_', 'resource'),
(59, 'ddd.xhtml#instrument__proektrovanij', 'https://ilb.github.io/devmethodology/ddd.xhtml#instrument__proektrovanij', 'resource'),
(60, 'iconix.xhtml#ICONIX', 'https://ilb.github.io/devmethodology/iconix.xhtml#ICONIX', 'resource'),
(61, 'iconix.xhtml#opisite_funkcional_n_e_trebovanij_v_ssego_porjdka', 'https://ilb.github.io/devmethodology/iconix.xhtml#opisite_funkcional_n_e_trebovanij_v_ssego_porjdka', 'resource'),
(62, 'iconix.xhtml#modelirovanie_predmetnoj_oblasti', 'https://ilb.github.io/devmethodology/iconix.xhtml#modelirovanie_predmetnoj_oblasti', 'resource'),
(63, 'iconix.xhtml#ispol_zujte_predmetnuy_oblast__kak_glossarij_proekta', 'https://ilb.github.io/devmethodology/iconix.xhtml#ispol_zujte_predmetnuy_oblast__kak_glossarij_proekta', 'resource'),
(64, 'iconix.xhtml#modelirovanie_precedentov', 'https://ilb.github.io/devmethodology/iconix.xhtml#modelirovanie_precedentov', 'resource'),
(65, 'iconixdevelopmentprocess.xhtml#process_razrabotki_ICONIX', 'https://ilb.github.io/devmethodology/iconixdevelopmentprocess.xhtml#process_razrabotki_ICONIX', 'resource'),
(66, 'interview.xhtml#vopros__interv_y', 'https://ilb.github.io/devmethodology/interview.xhtml#vopros__interv_y', 'resource'),
(67, 'knowlegebase.xhtml#baza_znanij', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#baza_znanij', 'resource'),
(68, 'knowlegebase.xhtml#biznes-sloj1', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#biznes-sloj1', 'resource'),
(69, 'knowlegebase.xhtml#kratkoe_opisanie_proekta', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#kratkoe_opisanie_proekta', 'resource'),
(70, 'knowlegebase.xhtml#doroznaj_karta', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#doroznaj_karta', 'resource'),
(71, 'knowlegebase.xhtml#zadaci_pol_zovatelj', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#zadaci_pol_zovatelj', 'resource'),
(72, 'knowlegebase.xhtml#material_', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#material_', 'resource'),
(73, 'knowlegebase.xhtml#variant__ispol_zovanij', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#variant__ispol_zovanij', 'resource'),
(74, 'knowlegebase.xhtml#biznes-pravila', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#biznes-pravila', 'resource'),
(75, 'knowlegebase.xhtml#shem__b', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#shem__b', 'resource'),
(76, 'knowlegebase.xhtml#kriterii_priemki', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#kriterii_priemki', 'resource'),
(77, 'knowlegebase.xhtml#scenarij_prodaz', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#scenarij_prodaz', 'resource'),
(78, 'knowlegebase.xhtml#tehniceskij_sloj1', 'https://ilb.github.io/devmethodology/knowlegebase.xhtml#tehniceskij_sloj1', 'resource'),
(79, 'productmanagement.xhtml#upravlenie_produktami', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#upravlenie_produktami', 'resource'),
(80, 'productmanagement.xhtml#s_cego_nacinaetsj_produkt', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#s_cego_nacinaetsj_produkt', 'resource'),
(81, 'productmanagement.xhtml#strategij_produkta', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#strategij_produkta', 'resource'),
(82, 'productmanagement.xhtml#analiz_dann_h', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#analiz_dann_h', 'resource'),
(83, 'productmanagement.xhtml#prioritizacij_zadac', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#prioritizacij_zadac', 'resource'),
(84, 'productmanagement.xhtml#zadaci_pol_zovatelej', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#zadaci_pol_zovatelej', 'resource'),
(85, 'productmanagement.xhtml#Job_To_Be_Done', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#Job_To_Be_Done', 'resource'),
(86, 'productmanagement.xhtml#interv_y_pol_zovatelej', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#interv_y_pol_zovatelej', 'resource'),
(87, 'productmanagement.xhtml#cto_v__hotite_sdelat__', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#cto_v__hotite_sdelat__', 'resource'),
(88, 'productmanagement.xhtml#kak_v__v_nastojsee_vremj_delaete_eto_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#kak_v__v_nastojsee_vremj_delaete_eto_', 'resource'),
(89, 'productmanagement.xhtml#kak_mozno_ulucsit__to__cto_v__delaete_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#kak_mozno_ulucsit__to__cto_v__delaete_', 'resource'),
(90, 'productmanagement.xhtml#proektirovanie_susnostej', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#proektirovanie_susnostej', 'resource'),
(91, 'productmanagement.xhtml#sostav_susnostej', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#sostav_susnostej', 'resource'),
(92, 'productmanagement.xhtml#sostojnie_susnosti', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#sostojnie_susnosti', 'resource'),
(93, 'productmanagement.xhtml#povedenie_susnostej', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#povedenie_susnostej', 'resource'),
(94, 'productmanagement.xhtml#otnosenij', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#otnosenij', 'resource'),
(95, 'productmanagement.xhtml#igra__susnosti_i_povedenie_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#igra__susnosti_i_povedenie_', 'resource'),
(96, 'productmanagement.xhtml#modelirovanie', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#modelirovanie', 'resource'),
(97, 'productmanagement.xhtml#metod__analiza_dann_h', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#metod__analiza_dann_h', 'resource'),
(98, 'productmanagement.xhtml#metriki', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#metriki', 'resource'),
(99, 'productmanagement.xhtml#harakteristiki_metriki', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#harakteristiki_metriki', 'resource'),
(100, 'productmanagement.xhtml#relevantnost_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#relevantnost_', 'resource'),
(101, 'productmanagement.xhtml#izmerimost_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#izmerimost_', 'resource'),
(102, 'productmanagement.xhtml#dejstvennost_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#dejstvennost_', 'resource'),
(103, 'productmanagement.xhtml#nadeznost_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#nadeznost_', 'resource'),
(104, 'productmanagement.xhtml#udobocitaemost_', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#udobocitaemost_', 'resource'),
(105, 'productmanagement.xhtml#voronka_prodaz', 'https://ilb.github.io/devmethodology/productmanagement.xhtml#voronka_prodaz', 'resource'),
(106, 'productteam.xhtml#produktovaj_komanda', 'https://ilb.github.io/devmethodology/productteam.xhtml#produktovaj_komanda', 'resource'),
(107, 'productteam.xhtml#formirovanie_komand', 'https://ilb.github.io/devmethodology/productteam.xhtml#formirovanie_komand', 'resource'),
(108, 'productteam.xhtml#avtonomnost__komand_', 'https://ilb.github.io/devmethodology/productteam.xhtml#avtonomnost__komand_', 'resource'),
(109, 'productteam.xhtml#menedzer_produkta', 'https://ilb.github.io/devmethodology/productteam.xhtml#menedzer_produkta', 'resource'),
(110, 'productteam.xhtml#dolznostn_e_objzannosti_menedzera_produkta', 'https://ilb.github.io/devmethodology/productteam.xhtml#dolznostn_e_objzannosti_menedzera_produkta', 'resource'),
(111, 'productteam.xhtml#menedzer_produkta_1__stazer_', 'https://ilb.github.io/devmethodology/productteam.xhtml#menedzer_produkta_1__stazer_', 'resource'),
(112, 'productteam.xhtml#menedzer_produkta_1__nacinaysij_', 'https://ilb.github.io/devmethodology/productteam.xhtml#menedzer_produkta_1__nacinaysij_', 'resource'),
(113, 'productteam.xhtml#menedzer_produkta_2__vedusij_', 'https://ilb.github.io/devmethodology/productteam.xhtml#menedzer_produkta_2__vedusij_', 'resource'),
(114, 'productteam.xhtml#menedzer_produkta_3__lider_', 'https://ilb.github.io/devmethodology/productteam.xhtml#menedzer_produkta_3__lider_', 'resource'),
(115, 'productteam.xhtml#menedzer_produkta_3__', 'https://ilb.github.io/devmethodology/productteam.xhtml#menedzer_produkta_3__', 'resource'),
(116, 'productteam.xhtml#ocenka_rezul_tatov_rabot_', 'https://ilb.github.io/devmethodology/productteam.xhtml#ocenka_rezul_tatov_rabot_', 'resource'),
(117, 'productteam.xhtml#prinjtie_resenij', 'https://ilb.github.io/devmethodology/productteam.xhtml#prinjtie_resenij', 'resource'),
(118, 'productteam.xhtml#analiz_dann_h', 'https://ilb.github.io/devmethodology/productteam.xhtml#analiz_dann_h', 'resource'),
(119, 'productteam.xhtml#kommunikacij', 'https://ilb.github.io/devmethodology/productteam.xhtml#kommunikacij', 'resource'),
(120, 'productteam.xhtml#obucenie_i_motivacij', 'https://ilb.github.io/devmethodology/productteam.xhtml#obucenie_i_motivacij', 'resource'),
(121, 'productteam.xhtml#dolzen_li_menedzer_produkta_umet__programmirovat__', 'https://ilb.github.io/devmethodology/productteam.xhtml#dolzen_li_menedzer_produkta_umet__programmirovat__', 'resource'),
(122, 'productteam.xhtml#dolzen_li_menedzer_produkta_ponimat__psihologiy__motivaciy_', 'https://ilb.github.io/devmethodology/productteam.xhtml#dolzen_li_menedzer_produkta_ponimat__psihologiy__motivaciy_', 'resource'),
(123, 'productteam.xhtml#i', 'https://ilb.github.io/devmethodology/productteam.xhtml#i', 'resource'),
(124, 'productteam.xhtml#dolznostn_e_objzannosti', 'https://ilb.github.io/devmethodology/productteam.xhtml#dolznostn_e_objzannosti', 'resource'),
(125, 'productteam.xhtml#inzener_1__stazer_', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_1__stazer_', 'resource'),
(126, 'productteam.xhtml#inzener_1__nacinaysij_', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_1__nacinaysij_', 'resource'),
(127, 'productteam.xhtml#inzener_2__vedusij_', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_2__vedusij_', 'resource'),
(128, 'productteam.xhtml#inzener_2__vedusij+_', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_2__vedusij+_', 'resource'),
(129, 'productteam.xhtml#inzener_3__lider_', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_3__lider_', 'resource'),
(130, 'productteam.xhtml#inzener_3__', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_3__', 'resource'),
(131, 'productteam.xhtml#inzener_3__1', 'https://ilb.github.io/devmethodology/productteam.xhtml#inzener_3__1', 'resource'),
(132, 'productteam.xhtml#arhitektor', 'https://ilb.github.io/devmethodology/productteam.xhtml#arhitektor', 'resource'),
(133, 'productteam.xhtml#ocenka_rezul_tatov_rabot_1', 'https://ilb.github.io/devmethodology/productteam.xhtml#ocenka_rezul_tatov_rabot_1', 'resource'),
(134, 'productteam.xhtml#analitik_dann_h', 'https://ilb.github.io/devmethodology/productteam.xhtml#analitik_dann_h', 'resource'),
(135, 'productteam.xhtml#QA-inzener', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener', 'resource'),
(136, 'productteam.xhtml#dolznostn_e_objzannosti1', 'https://ilb.github.io/devmethodology/productteam.xhtml#dolznostn_e_objzannosti1', 'resource'),
(137, 'productteam.xhtml#QA-inzener_1__', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener_1__', 'resource'),
(138, 'productteam.xhtml#QA-inzener_1__nacinaysij_', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener_1__nacinaysij_', 'resource'),
(139, 'productteam.xhtml#QA-inzener_1__vedusij_', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener_1__vedusij_', 'resource'),
(140, 'productteam.xhtml#QA-inzener1', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener1', 'resource'),
(141, 'productteam.xhtml#QA-inzener_3__lider_', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener_3__lider_', 'resource'),
(142, 'productteam.xhtml#QA-inzener_3__', 'https://ilb.github.io/devmethodology/productteam.xhtml#QA-inzener_3__', 'resource'),
(143, 'productteam.xhtml#ocenka_rezul_tatov_rabot_11', 'https://ilb.github.io/devmethodology/productteam.xhtml#ocenka_rezul_tatov_rabot_11', 'resource'),
(144, 'productteam.xhtml#stakeholders', 'https://ilb.github.io/devmethodology/productteam.xhtml#stakeholders', 'resource'),
(145, 'skills.xhtml#inzener-programmist', 'https://ilb.github.io/devmethodology/skills.xhtml#inzener-programmist', 'resource'),
(146, 'skills.xhtml#menedzer_produkta', 'https://ilb.github.io/devmethodology/skills.xhtml#menedzer_produkta', 'resource'),
(147, 'tdd.xhtml#Test_driven_design', 'https://ilb.github.io/devmethodology/tdd.xhtml#Test_driven_design', 'resource'),
(148, 'tdd.xhtml#Definition', 'https://ilb.github.io/devmethodology/tdd.xhtml#Definition', 'resource'),
(149, 'tdd.xhtml#Problems', 'https://ilb.github.io/devmethodology/tdd.xhtml#Problems', 'resource'),
(150, 'tdd.xhtml#Nightmare_to_maintain__slow_to_develop', 'https://ilb.github.io/devmethodology/tdd.xhtml#Nightmare_to_maintain__slow_to_develop', 'resource'),
(151, 'tdd.xhtml#Failing_to_meet_actual_need', 'https://ilb.github.io/devmethodology/tdd.xhtml#Failing_to_meet_actual_need', 'resource'),
(152, 'tdd.xhtml#Solution', 'https://ilb.github.io/devmethodology/tdd.xhtml#Solution', 'resource'),
(153, 'tdd.xhtml#Build_thing_right:_TDD', 'https://ilb.github.io/devmethodology/tdd.xhtml#Build_thing_right:_TDD', 'resource'),
(154, 'tdd.xhtml#TDD', 'https://ilb.github.io/devmethodology/tdd.xhtml#TDD', 'resource'),
(155, 'tdd.xhtml#TEST_FIRST', 'https://ilb.github.io/devmethodology/tdd.xhtml#TEST_FIRST', 'resource'),
(156, 'tdd.xhtml#Build_right_t', 'https://ilb.github.io/devmethodology/tdd.xhtml#Build_right_t', 'resource'),
(157, 'tdd.xhtml#Close_collaboration', 'https://ilb.github.io/devmethodology/tdd.xhtml#Close_collaboration', 'resource'),
(158, 'tdd.xhtml#Shared_language', 'https://ilb.github.io/devmethodology/tdd.xhtml#Shared_language', 'resource'),
(159, 'usecases.xhtml#diagramm__precedentov', 'https://ilb.github.io/devmethodology/usecases.xhtml#diagramm__precedentov', 'resource'),
(160, 'usecases.xhtml#element__diagramm_', 'https://ilb.github.io/devmethodology/usecases.xhtml#element__diagramm_', 'resource'),
(161, 'usecases.xhtml#dejstvuysee_lico', 'https://ilb.github.io/devmethodology/usecases.xhtml#dejstvuysee_lico', 'resource'),
(162, 'usecases.xhtml#precedent', 'https://ilb.github.io/devmethodology/usecases.xhtml#precedent', 'resource'),
(163, 'usecases.xhtml#svjz_', 'https://ilb.github.io/devmethodology/usecases.xhtml#svjz_', 'resource');

-- --------------------------------------------------------

--
-- Структура таблицы `material_from_keyword`
--

CREATE TABLE `material_from_keyword` (
  `material_id` int(7) NOT NULL,
  `keyword_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `material_from_keyword`
--

INSERT INTO `material_from_keyword` (`material_id`, `keyword_id`) VALUES
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 6),
(5, 7),
(5, 8),
(5, 9),
(5, 10),
(5, 11),
(6, 12),
(6, 13),
(6, 14),
(6, 15),
(7, 16),
(7, 17),
(7, 18),
(7, 19),
(7, 20),
(7, 21),
(7, 22),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(8, 29),
(8, 30),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(8, 35),
(8, 36),
(8, 37),
(8, 38),
(8, 39),
(8, 40),
(8, 41),
(8, 42),
(9, 43),
(9, 44),
(9, 45),
(9, 46),
(9, 47),
(10, 48),
(11, 49),
(12, 50),
(12, 51),
(12, 52),
(12, 53),
(12, 54),
(12, 55),
(12, 56),
(12, 57),
(12, 58),
(12, 59),
(12, 60),
(12, 61),
(13, 62),
(13, 63),
(13, 64),
(13, 65),
(13, 66),
(13, 67),
(13, 68),
(13, 69),
(13, 70),
(13, 71),
(13, 72),
(13, 73),
(13, 74),
(13, 75),
(13, 76),
(13, 77),
(13, 78),
(13, 79),
(13, 80),
(13, 81),
(13, 82),
(13, 83),
(13, 84),
(13, 85),
(13, 86),
(13, 87),
(13, 88),
(14, 89),
(14, 90),
(14, 91),
(14, 92),
(14, 93),
(14, 94),
(14, 95),
(14, 96),
(14, 97),
(14, 98),
(14, 99),
(14, 100),
(14, 101),
(14, 102),
(14, 103),
(14, 104),
(14, 105),
(14, 106),
(14, 107),
(14, 108),
(14, 109),
(14, 110),
(14, 111),
(14, 112),
(14, 113),
(14, 114),
(14, 115),
(14, 116),
(14, 117),
(14, 118),
(14, 119),
(14, 120),
(14, 121),
(14, 122),
(14, 123),
(14, 124),
(14, 125),
(14, 126),
(14, 127),
(15, 128),
(15, 129),
(16, 130),
(16, 131),
(16, 132),
(16, 133),
(16, 134),
(16, 135),
(16, 136),
(16, 137),
(16, 138),
(16, 139),
(16, 140),
(16, 141),
(17, 142),
(17, 143),
(17, 144),
(17, 145),
(17, 146);

-- --------------------------------------------------------

--
-- Структура таблицы `offers`
--

CREATE TABLE `offers` (
  `id_offer` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `diff` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id_subscription` int(7) NOT NULL,
  `user_id` int(7) NOT NULL,
  `material_id` int(7) NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id_user` int(7) NOT NULL,
  `login` varchar(30) NOT NULL,
  `status` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id_user`, `login`, `status`) VALUES
(1, 'USer1', 'user'),
(2, 'User2', 'mentor');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `keyword`
--
ALTER TABLE `keyword`
  ADD PRIMARY KEY (`id_keyword`);

--
-- Индексы таблицы `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`);

--
-- Индексы таблицы `material_from_keyword`
--
ALTER TABLE `material_from_keyword`
  ADD KEY `keyword_id` (`keyword_id`),
  ADD KEY `material_from_keyword_ibfk_2` (`material_id`);

--
-- Индексы таблицы `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id_offer`),
  ADD KEY `offers_ibfk_1` (`material_id`),
  ADD KEY `offers_ibfk_2` (`user_id`);

--
-- Индексы таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id_subscription`),
  ADD KEY `subscriptions_ibfk_1` (`material_id`),
  ADD KEY `subscriptions_ibfk_2` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `keyword`
--
ALTER TABLE `keyword`
  MODIFY `id_keyword` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT для таблицы `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT для таблицы `offers`
--
ALTER TABLE `offers`
  MODIFY `id_offer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id_subscription` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `material_from_keyword`
--
ALTER TABLE `material_from_keyword`
  ADD CONSTRAINT `material_from_keyword_ibfk_1` FOREIGN KEY (`keyword_id`) REFERENCES `keyword` (`id_keyword`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `material_from_keyword_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offers_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`material_id`) REFERENCES `material` (`id_material`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
