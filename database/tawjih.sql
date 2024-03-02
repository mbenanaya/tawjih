-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 13 juin 2023 à 18:32
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tawjih`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `tele` varchar(15) DEFAULT NULL,
  `nomAffichage` varchar(100) DEFAULT NULL,
  `active` int(11) DEFAULT 1,
  `photo` varchar(200) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `id_Who_Creatit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `id_admin`, `fname`, `lname`, `tele`, `nomAffichage`, `active`, `photo`, `email`, `password`, `id_Who_Creatit`) VALUES
(1, 124345, 'Admin', 'Admin', '0612345678', 'Admin', 1, '1686664880_ADMIN_1684949445_RESPONSABLE_Mouhcine_BEN-ANAYA_20230501161836.jpg', 'admin@gmail.com', 'Admin1234', NULL),
(7, 1100173237, 'Admin-2', 'Admin-2', '0612345678', 'Admin-2', 1, '1686666224_ADMIN_1684949445_RESPONSABLE_Mouhcine_BEN-ANAYA_20230501161836.jpg', 'admin_2@gmail.com', 'admin_2@gmail.com', 124345);

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre_article` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `titre_concours` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `audio` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `date_concours` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `lien_ecole` varchar(255) NOT NULL,
  `lien_video` varchar(220) NOT NULL,
  `bacs` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre_article`, `image`, `titre_concours`, `pdf`, `audio`, `video`, `date_concours`, `description`, `lien_ecole`, `lien_video`, `bacs`, `created_at`) VALUES
(1, 'Inscription Formation Professionnel OFPPT ITA / ISTA', '1686669359_ofppt.png', 'Inscription Formation Professionnel OFPPT ITA / ISTA', '1686669359_1684435395_nomFichier6616.pdf', '1686669359_sound_1.mp3', '', '2023-09-01', '<p style=\"text-align: left;\"><span style=\"color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;التقني متخصص + التقني + الـتاهيل + التخصص</span></p><p style=\"text-align: left;\"><span style=\"color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Technicien Spécialisé + Technicien + Qualification+ S</span><span style=\"color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254);\">pécialisation</span></p><p style=\"text-align: left;\"><span style=\"color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254);\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; inscription My Way 2023 / 2024</span></p><p><div style=\"text-align: left;\"><span style=\"background-color: rgb(254, 254, 254); color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; + جدولة مختلف العمليات 2024/2023&nbsp;</span></div><span style=\"color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254);\"><div style=\"text-align: center;\">التسجيل + النتائج</div></span><span style=\"font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254); color: rgb(226, 80, 65);\"><div style=\"text-align: center;\">شرح شامل<span style=\"color: rgb(20, 20, 20);\">&nbsp;: لطريقة التسجيل الجديدة بالتكوين المهني</span></div></span><span style=\"color: rgb(20, 20, 20); font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254);\"><div style=\"text-align: center;\">شروحات حصرية موقع توجيه نت.نت</div></span><span style=\"font-family: Tawjihnet, sans-serif; font-size: 18px; text-align: center; background-color: rgb(254, 254, 254); color: rgb(226, 80, 65);\"><div style=\"text-align: center;\">معاهد التكوين في مهن الصحة والمساعدة الاجتماعية IFMSAS</div></span><span style=\"text-align: center; background-color: rgb(254, 254, 254);\"><div style=\"text-align: center;\"><font color=\"#141414\" face=\"Tawjihnet, sans-serif\"><span style=\"font-size: 18px;\"><br></span></font></div></span><span style=\"text-align: center; background-color: rgb(254, 254, 254);\"><div style=\"text-align: center;\"><font color=\"#141414\" face=\"Tawjihnet, sans-serif\"><span style=\"font-size: 18px;\"><br></span></font></div></span><div style=\"text-align: center;\"><br></div></p>', 'https://www.ofppt.ma/fr/inscription-en-ligne?utm_source=Bouton%20Inscription&amp;utm_medium=CTA&amp;utm_campaign=inscription', 'https://www.youtube.com/embed/36Oaqtx4WkA', '1,2,3,4,5,6,7,8,9,10,11,12,13,14', '2023-06-13 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `article_etr`
--

CREATE TABLE `article_etr` (
  `id` int(10) UNSIGNED NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description_article` longtext NOT NULL,
  `lien` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `pdf` varchar(255) NOT NULL DEFAULT '',
  `audio` varchar(255) NOT NULL DEFAULT '',
  `video` varchar(255) NOT NULL DEFAULT '',
  `id_pays` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_etr`
--

INSERT INTO `article_etr` (`id`, `titre`, `description_article`, `lien`, `image`, `pdf`, `audio`, `video`, `id_pays`, `created_at`, `updated_at`) VALUES
(3, 'دراسة الصيدلة في روسيا', '<p style=\"border: 0px; margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; padding: 0px; color: rgb(58, 58, 58); font-family: Arial, Helvetica, sans-serif; font-size: 18px; text-align: justify;\"><span style=\"border: 0px; margin: 0px; padding: 0px; font-size: 14pt;\">يرغب العديد من الطلاب فى السفر إلى روسيا لدراسة الصيدلة ، مع العلم أنه تم إنشاء كلية الصيدلة عام 1966م ، وقد تقوم هذه الكلية بإعداد الطلاب للعمل فى الصيدلة مع الفهم الكامل للادوية والأمراض ، وهذا الأمر هو ما يعزز المنهج والتفاعل بين الصيادلة وغيرهم من المهنين الصحيين ، مع الأخذ فى الإعتبار أن مدة الدراسة خمس سنوات للحصول على الدرجة الدوائية .</span></p><p style=\"border: 0px; margin-right: 0px; margin-bottom: 1.5em; margin-left: 0px; padding: 0px; color: rgb(58, 58, 58); font-family: Arial, Helvetica, sans-serif; font-size: 18px; text-align: justify;\"><span style=\"border: 0px; margin: 0px; padding: 0px; font-size: 14pt;\">كما يمكننا القول أنه يتم تدريس الصيدلة فى فصول دراسية ، وكل فصل دراسيى ينتهى&nbsp; بإمتحانات أو عروض للمشروع ، ومن الجدير بالإهتمام أن الدراسة تتكون من محاضرات وندوات فضلا عن الجلسات العملية&nbsp; ولقد تم تصميم المناهج الدراسية لكسر الحواجز بين التخصصات ومساعدة الطلاب على التعلم بسرعة أكبر مع إمكانية دمج التدريس وتسهيل تعرض الطلاب للعلوم الأساسية والتطبيقية والممارسة المهنية فى سياق رعاية المرضي .</span></p>', 'russia.ru', '230531161917russia_pharmacy.jpg', '230531161917ensa.pdf', '230531161917audio.mp3', '230531161917video.mp4', 2, '2023-05-31 14:19:17', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `bac`
--

CREATE TABLE `bac` (
  `idBac` int(11) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `sectorFR` varchar(100) NOT NULL,
  `abbreviation` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `bac`
--

INSERT INTO `bac` (`idBac`, `sector`, `sectorFR`, `abbreviation`) VALUES
(1, 'علوم رياضية أ', 'SCIENCES MATHÉMATIQUES A', 'SMA'),
(2, ' علوم رياضية ب', 'SCIENCES MATHÉMATIQUES B', 'SMB'),
(3, ' علوم الحياة و الارض', 'SVT', 'SVT'),
(4, ' علوم زراعية', 'SCIENCES AGRONOMIQUES', ''),
(5, ' العلوم والتكنولوجيات الكهربائية', 'SCIENCES ET TECHNOLOGIES ÉLECTRIQUES', 'STE'),
(6, ' العلوم والتكنولوجيات الميكانيكية', 'SCIENCES ET TECHNOLOGIES MÉCANIQUES', 'STM'),
(7, '  فنون التطبيقية', 'ARTS APPLIQUÉS', ''),
(8, ' العلوم الاقتصادية', 'SCIENCES ÉCONOMIQUES', ''),
(9, '  علوم التدبير المحاسباتي', 'TECHNIQUES DE GESTION ET COMPTABILITÉ', ''),
(10, ' الآداب', 'LETTRES', ''),
(11, ' العلوم الإنسانية', 'SCIENCES HUMAINES', 'SH'),
(12, ' اللغة العربية', 'LANGUE ARABE', ''),
(13, 'علوم شرعية', 'SCIENCES DE LA CHARIAA', ''),
(14, 'علوم فيزيائية', 'SCIENCES PHYSIQUES', 'PC');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `idCity` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `idRegion` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`idCity`, `name`, `idRegion`) VALUES
(1, 'Tanger-Assilah', 1),
(2, 'M\'diq-Fnideq', 1),
(3, 'Tétouan', 1),
(4, 'Fahs-Anjra', 1),
(5, 'Larache', 1),
(6, 'Al Hoceïma', 1),
(7, 'Chefchaouen', 1),
(8, 'Ouezzane', 1),
(9, 'Oujda-Angad', 2),
(10, 'Nador', 2),
(11, 'Driouch', 2),
(12, 'Jerada', 2),
(13, 'Berkane', 2),
(14, 'Taourirt', 2),
(15, 'Guercif', 2),
(16, 'Figuig', 2),
(17, 'Fès', 3),
(18, 'Meknès', 3),
(19, 'El Hajeb', 3),
(20, 'Ifrane', 3),
(21, 'Moulay Yaâcoub', 3),
(22, 'Séfrou', 3),
(23, 'Boulemane', 3),
(24, 'Taounate', 3),
(25, 'Taza', 3),
(26, 'Rabat', 4),
(27, 'Salé', 4),
(28, 'Skhirate-Témara', 4),
(29, 'Kénitra', 4),
(30, 'Khémisset', 4),
(31, 'Sidi Kacem', 4),
(32, 'Sidi Slimane', 4),
(33, 'Béni-Mellal', 5),
(34, 'Azilal', 5),
(35, 'Fquih Ben Salah', 5),
(36, 'Khénifra', 5),
(37, 'Khouribga', 5),
(38, 'Casablanca', 6),
(39, 'Mohammédia', 6),
(40, 'Jadida', 6),
(41, 'Nouaceur', 6),
(42, 'Médiouna', 6),
(43, 'Benslimane', 6),
(44, ' Berrechid', 6),
(45, 'Settat', 6),
(46, 'Sidi Bennour', 6),
(47, 'Marrakech', 7),
(48, 'Chichaoua', 7),
(49, 'Al Haouz', 7),
(50, 'El Kelaâ des Sraghna', 7),
(51, 'Essaouira', 7),
(52, 'Rehamna', 7),
(53, 'Safi', 7),
(54, 'Youssoufia', 7),
(55, 'Errachidia', 8),
(56, 'Ouarzazate', 8),
(57, 'Midelt', 8),
(58, 'Tinghir', 8),
(59, 'Zagora', 8),
(60, 'Agadir Ida-Outanane', 9),
(61, 'Inezgane-Aït Melloul', 9),
(62, 'Chtouka-Aït Baha', 9),
(63, 'Taroudant', 9),
(64, 'Tiznit', 9),
(65, 'Tata', 9),
(66, 'Guelmim', 10),
(67, 'Assa-Zag', 10),
(68, 'Tan-Tan', 10),
(69, 'Sidi Ifni', 10),
(70, 'Laâyoune', 11),
(71, 'Boujdour', 11),
(72, 'Tarfaya', 11),
(73, 'Es-Semara', 11),
(74, 'Oued Ed Dahab', 12),
(75, 'Aousserd', 12);

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `publier` int(1) DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `student_CodeMassar` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `publier`, `created_at`, `student_CodeMassar`) VALUES
(1, 'موقع مفيد جداً شكراً لكم بفضلكم تم قبولي في مدرسة الطب وصيدلة', 1, '2023-06-13', 'D12345678'),
(2, 'Equipe jeune et dynamique, très professionnelle et à l’écoute, Un grand merci, pour votre implication, disponibilité, professionnalisme, patience et flexibilité.', 1, '2023-06-13', 'D12345678');

-- --------------------------------------------------------

--
-- Structure de la table `demande_inscription`
--

CREATE TABLE `demande_inscription` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `tele` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `methodePayment` int(11) DEFAULT NULL,
  `idPack` int(11) DEFAULT NULL,
  `idResponsable` int(11) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `demande_inscription`
--

INSERT INTO `demande_inscription` (`id`, `nom`, `prenom`, `tele`, `email`, `status`, `methodePayment`, `idPack`, `idResponsable`, `created_at`) VALUES
(1, 'ouahki', 'mohamed', '0615893481', 'mohamedouahki123@gmail.com', 2, 1, 1, 1, '2023-06-13');

-- --------------------------------------------------------

--
-- Structure de la table `establishments`
--

CREATE TABLE `establishments` (
  `id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `sector` varchar(600) NOT NULL,
  `last_deadline` date NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `establishments`
--

INSERT INTO `establishments` (`id`, `title`, `sector`, `last_deadline`, `logo`) VALUES
(1, 'OFPPT', 'full stack , mobile', '2023-07-30', 'uploads/logo-establishments/64888177b9519logoOfppt.png'),
(2, 'ENSA de Marrakech', 'Systèmes Electroniques Embarqués et Commande des Systèmes', '2023-07-13', 'uploads/logo-establishments/6488822f2136aOIP.jpeg'),
(3, 'FST MARRAKECH', 'BCG, MIPC', '2023-07-20', 'uploads/logo-establishments/64888275cbcd4fstg13.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `lycee`
--

CREATE TABLE `lycee` (
  `idLycee` int(11) NOT NULL,
  `nameFr` varchar(200) NOT NULL,
  `nameAr` varchar(200) NOT NULL,
  `addressFr` varchar(300) NOT NULL,
  `addressAr` varchar(300) NOT NULL,
  `city` varchar(100) NOT NULL,
  `region` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lycee`
--

INSERT INTO `lycee` (`idLycee`, `nameFr`, `nameAr`, `addressFr`, `addressAr`, `city`, `region`) VALUES
(1, 'lycee mohamed 6', 'المدرسة الثانوية', 'azli sud 5, marrakech', 'المسيرة 1 مراكش', '47', 7);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `outgoing_id` int(11) DEFAULT NULL,
  `incoming_id` int(11) DEFAULT NULL,
  `id_student` int(11) DEFAULT NULL,
  `id_responsable` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `message` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`msg_id`, `outgoing_id`, `incoming_id`, `id_student`, `id_responsable`, `id_admin`, `status`, `created_at`, `message`) VALUES
(1, 1613344393, 124345, NULL, 1613344393, 124345, 1, '2023-06-13 15:51:46', 'hello'),
(2, 124345, 1613344393, NULL, 1613344393, 124345, 1, '2023-06-13 15:52:49', 'hi'),
(3, 141191356, 1613344393, 141191356, 1613344393, NULL, 1, '2023-06-13 15:59:48', 'ee'),
(4, 141191356, 1613344393, 141191356, 1613344393, NULL, 1, '2023-06-13 16:00:22', 'hi'),
(5, 141191356, 1613344393, 141191356, 1613344393, NULL, 1, '2023-06-13 16:03:38', 'test chat'),
(6, 141191356, 1613344393, 141191356, 1613344393, NULL, 1, '2023-06-13 16:06:53', 'gg'),
(7, 141191356, 1613344393, 141191356, 1613344393, NULL, 1, '2023-06-13 16:08:44', 'hh'),
(8, 141191356, 1613344393, 141191356, 1613344393, NULL, 0, '2023-06-13 16:08:54', 'nn');

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id_notif` int(10) UNSIGNED NOT NULL,
  `notif_subject` varchar(255) NOT NULL,
  `notif_text` varchar(255) NOT NULL,
  `id_student` longtext DEFAULT NULL,
  `read_status` longtext DEFAULT '1',
  `id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id_notif`, `notif_subject`, `notif_text`, `id_student`, `read_status`, `id`, `created_at`, `updated_at`) VALUES
(1, 'notif test', '', '742936836', '1,742936836', NULL, '2023-06-11 13:30:11', NULL),
(2, 'مباراة جديدة', 'تم الاعلان عن test', '742936836', '1,742936836', 1, '2023-06-11 13:31:01', NULL),
(3, 'هناك تحديث', 'هناك تحديث بخصوص test', '742936836', '1,742936836', 1, '2023-06-11 13:32:05', NULL),
(4, 'notif test', 'sdjijkc cdjn', '742936836', '1,742936836', NULL, '2023-06-11 13:36:02', NULL),
(5, 'مباراة جديدة', 'تم الاعلان عن test concour', '742936836,1026006752,330062863,117900478,711759455', '1', 2, '2023-06-12 15:26:31', NULL),
(6, 'مباراة جديدة', 'تم الاعلان عن test conours', '742936836,1026006752,330062863,117900478,711759455', '1', 3, '2023-06-12 15:27:51', NULL),
(7, 'هناك تحديث', 'هناك تحديث بخصوص test conours', '742936836,1026006752,330062863,117900478,711759455', '1', 3, '2023-06-12 15:29:53', NULL),
(8, 'هناك تحديث', 'هناك تحديث بخصوص test conours', '742936836,1026006752,330062863,117900478,711759455', '1', 3, '2023-06-12 15:48:42', NULL),
(9, 'هناك تحديث', 'هناك تحديث بخصوص test conours', '742936836,1026006752,330062863,117900478,711759455', '1,742936836', 3, '2023-06-12 15:54:05', NULL),
(10, 'هناك تحديث', 'هناك تحديث بخصوص test conours', '742936836,1026006752,330062863,117900478,711759455', '1,742936836', 3, '2023-06-12 15:56:41', NULL),
(11, 'notif test', 'notif for make notification', '742936836', '1,742936836', NULL, '2023-06-12 19:04:36', NULL),
(12, '', '', '742936836,117900478,742936836,117900478,742936836,117900478', '1,742936836', NULL, '2023-06-12 19:23:56', NULL),
(13, 'notif test', 'test', '742936836,1026006752', '1,742936836', NULL, '2023-06-12 19:34:10', NULL),
(14, 'هناك تحديث', 'هناك تحديث بخصوص test concour', '742936836,1026006752,330062863,117900478,711759455', '1', 2, '2023-06-12 19:44:26', NULL),
(15, 'هناك تحديث', 'هناك تحديث بخصوص test concour', '742936836,1026006752,330062863,117900478,711759455', '1', 2, '2023-06-12 20:14:05', NULL),
(16, 'مباراة جديدة', 'تم الاعلان عن test m3a 20', '742936836,1026006752,330062863,117900478,711759455', '1', 4, '2023-06-12 20:16:59', NULL),
(17, 'هناك تحديث', 'هناك تحديث بخصوص test m3a 20', '742936836,1026006752,330062863,117900478,711759455', '1', 4, '2023-06-12 20:18:14', NULL),
(18, 'هناك تحديث', 'هناك تحديث بخصوص test', '742936836,1026006752,330062863,117900478,711759455', '1', 1, '2023-06-12 20:22:58', NULL),
(19, 'هناك تحديث', 'هناك تحديث بخصوص test', '742936836,1026006752,330062863,117900478,711759455', '1', 1, '2023-06-12 20:23:29', NULL),
(20, 'هناك تحديث', 'هناك تحديث بخصوص test', '742936836,1026006752,330062863,117900478,711759455', '1', 1, '2023-06-12 20:25:43', NULL),
(21, 'هناك تحديث', 'هناك تحديث بخصوص test', '742936836,1026006752,330062863,117900478,711759455', '1', 1, '2023-06-12 20:33:52', NULL),
(22, 'مباراة جديدة', 'تم الاعلان عن test m3a 20:51', '742936836,1026006752,330062863,117900478,711759455', '1', 5, '2023-06-12 20:54:45', NULL),
(23, 'هناك تحديث', 'هناك تحديث بخصوص test m3a 20:51', '742936836,1026006752,330062863,117900478,711759455', '1', 5, '2023-06-12 20:56:06', NULL),
(24, 'مباراة جديدة', 'تم الاعلان عن Modèles Préparation Concours Bac ENSA ENCG Médecine APESA ISIT', '742936836,1026006752', '1,742936836', 6, '2023-06-12 23:15:17', NULL),
(25, 'هناك تحديث', 'هناك تحديث بخصوص Modèles Préparation Concours Bac ENSA ENCG Médecine APESA ISIT', '742936836,1026006752', '1,742936836', 6, '2023-06-12 23:26:52', NULL),
(26, 'هناك تحديث', 'هناك تحديث بخصوص Modèles Préparation Concours Bac ENSA ENCG Médecine APESA ISIT', '742936836,1026006752', '1,742936836', 6, '2023-06-12 23:27:53', NULL),
(27, 'هناك تحديث', 'هناك تحديث بخصوص Modèles Préparation Concours Bac ENSA ENCG Médecine APESA ISIT', '742936836,1026006752', '1,742936836', 6, '2023-06-13 01:30:13', NULL),
(28, 'مباراة جديدة', 'تم الاعلان عن Inscription Formation Professionnel OFPPT ITA / ISTA', '141191356', '1,141191356', 1, '2023-06-13 16:15:59', NULL),
(29, 'notif test', 'test motif', '141191356', '1,141191356', NULL, '2023-06-13 17:28:13', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `packs`
--

CREATE TABLE `packs` (
  `idPack` int(11) NOT NULL,
  `domaineP` varchar(255) DEFAULT NULL,
  `domaineAbreviationP` varchar(255) DEFAULT NULL,
  `avantage1P` text DEFAULT NULL,
  `avantage2P` text DEFAULT NULL,
  `prixPack` float DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `bacs` text DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT 0,
  `id_who_created` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `packs`
--

INSERT INTO `packs` (`idPack`, `domaineP`, `domaineAbreviationP`, `avantage1P`, `avantage2P`, `prixPack`, `color`, `bacs`, `active`, `id_who_created`, `created_at`) VALUES
(1, 'SCIENCE NORMAL', 'SN', 'ALJISR informe l\'abonné des nouveautés des concours d\'accès aux écoles', 'L\'abonné se charge lui-même des candidatures et leurs suivi avec l\'assistance d\'ALJISR', 400, '#09afed', '1.3.14.', 1, 1, '2023-05-11 00:00:00'),
(2, 'SCIENCE SPECIAL', 'SP', 'ALJISR informe l\'abonné des nouveautés des concours d\'accès aux écoles', 'ALJISR se charge des candidatures et leurs suivi à la place de l\'abonné', 2500, '#5bc1ac', '1.3.14.', 1, 1, '2023-05-11 00:00:00'),
(3, 'ECO, TECH, ET LETTRES', 'ETL', 'ALJISR informe l\'abonné des nouveautés des concours d\'accès aux écoles', 'L\'abonné se charge lui-même des candidatures et leurs suivi avec l\'assistance d\'ALJISR', 400, '#e66559', '5.6.11.', 1, 1, '2023-05-11 00:00:00'),
(4, 'ECONOMIE SPECIAL', 'EP', 'ALJISR informe l\'abonné des nouveautés des concours d\'accès aux écoles', 'ALJISR se charge des candidatures et leurs suivi à la place de l\'abonné', 1500, '#89b1eb', '3.11.14.', 1, 1, '2023-05-11 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

CREATE TABLE `pays` (
  `idPays` int(10) UNSIGNED NOT NULL,
  `nomPays` varchar(255) NOT NULL,
  `nomPaysFr` varchar(255) NOT NULL,
  `imagePays` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`idPays`, `nomPays`, `nomPaysFr`, `imagePays`, `description`, `created_at`, `updated_at`) VALUES
(2, 'روسيا', 'Russie', 'Russie_russia.jpeg', 'تعرف على الشعب الممكن دراستها في روسيا', NULL, NULL),
(12, 'اسبانيا', 'Espagne', 'Espagne_spain.jpeg', 'تعرف على الشعب الممكن دراستها في اسبانيا', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recus`
--

CREATE TABLE `recus` (
  `id` int(11) NOT NULL,
  `id_establishment` int(11) NOT NULL,
  `id_student` varchar(100) NOT NULL,
  `newName` varchar(300) NOT NULL,
  `oldName` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `recus`
--

INSERT INTO `recus` (`id`, `id_establishment`, `id_student`, `newName`, `oldName`, `type`, `size`, `position`) VALUES
(1, 1, 'D12345678', '64888e72a6cacCertification.pdf', 'Certification.pdf', 'application/pdf', '1128.4 KB', '../uploads/recus/64888e72a6cacCertification.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

CREATE TABLE `region` (
  `idRegion` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`idRegion`, `name`) VALUES
(1, 'Tanger-Tétouan-Al Hoceïma'),
(2, 'Oriental'),
(3, 'Fès-Meknès'),
(4, 'Rabat-Salé-Kénitra'),
(5, 'Béni Mellal-Khénifra'),
(6, 'Casablanca-Settat'),
(7, 'Marrakech-Safi'),
(8, 'Drâa-Tafilalet'),
(9, 'Souss-Massa'),
(10, 'Guelmim-Oued Noun'),
(11, 'Laâyoune-Sakia El Hamra'),
(12, 'Dakhla-Oued Ed-Dahab');

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `id_student` varchar(255) NOT NULL,
  `date_request` datetime NOT NULL DEFAULT current_timestamp(),
  `state` varchar(100) NOT NULL DEFAULT 'en-cours'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `responsables`
--

CREATE TABLE `responsables` (
  `idRes` int(11) NOT NULL,
  `idRes_gen` int(11) DEFAULT NULL,
  `cinRes` varchar(10) DEFAULT NULL,
  `nomRes` varchar(110) DEFAULT NULL,
  `prenomRes` varchar(100) DEFAULT NULL,
  `nomAffichage` varchar(255) DEFAULT NULL,
  `teleRes` varchar(15) DEFAULT NULL,
  `addressRes` varchar(255) DEFAULT NULL,
  `cnssRes` varchar(20) DEFAULT NULL,
  `salaireRes` float DEFAULT NULL,
  `dateNaissRes` date DEFAULT NULL,
  `dateEmbaucheRes` date DEFAULT NULL,
  `emailRes` varchar(100) DEFAULT NULL,
  `passwordRes` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `active` int(1) DEFAULT 1,
  `typeUser` int(11) NOT NULL DEFAULT 1,
  `isOnlige` varchar(50) NOT NULL DEFAULT 'en ligne',
  `created_at` date DEFAULT current_timestamp(),
  `id_who_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responsables`
--

INSERT INTO `responsables` (`idRes`, `idRes_gen`, `cinRes`, `nomRes`, `prenomRes`, `nomAffichage`, `teleRes`, `addressRes`, `cnssRes`, `salaireRes`, `dateNaissRes`, `dateEmbaucheRes`, `emailRes`, `passwordRes`, `photo`, `active`, `typeUser`, `isOnlige`, `created_at`, `id_who_created`) VALUES
(1, 1613344393, 'EE123456', 'Responsables-1', 'Responsables-1', 'Responsables-1', '0612345678', 'marrakech,Azli', '1234567cnss', 3000, '1995-06-15', '2018-10-17', 'responsable@gmail.com', '$2y$10$b2YTCWRVYXsrIttfKIv1g.354rus7rtb1/YmPW9VFaYfcfRsxXHSa', '1686666987_RESPONSABLE_1684949445_RESPONSABLE_Mouhcine_BEN-ANAYA_20230501161836.jpg', 1, 1, 'en ligne', '2023-06-13', 1),
(2, 1673212006, 'EE123457', 'Responsables-2', 'Responsables-2', 'Responsables-2', '0612345678', 'marrakech,Azli', '12356567cnss', 2000, '1992-10-22', '2008-06-13', 'Responsables_2@gmail.com', '$2y$10$OallVZKuF8KzRI96A8hl0O99Du2sZtW/Uf5yKRixkjecJSVaHQCUi', '1686667443_RESPONSABLE_1684949445_RESPONSABLE_Mouhcine_BEN-ANAYA_20230501161836.jpg', 1, 1, 'en ligne', '2023-06-13', 1);

-- --------------------------------------------------------

--
-- Structure de la table `stripe_account`
--

CREATE TABLE `stripe_account` (
  `id` int(11) NOT NULL,
  `secret_key` varchar(300) NOT NULL,
  `publishable_key` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `stripe_account`
--

INSERT INTO `stripe_account` (`id`, `secret_key`, `publishable_key`) VALUES
(1, 'sk_test_51NGIB8LfJf4DTuaznMgGNE6MNzjoUlZ7egG6ar7EHMBBMN72GybsVY03sAWQ41FhGhILyY7IF3qGWFPIa4UyGOhp00kVJKdGYj', 'pk_test_51NGIB8LfJf4DTuazImahwlLYrCPrJMu6g5GR2yVfy5y0bgF7POMxjEImUNahC8UzhnCufTc6yJ1ZBugztHan5pLN00cMM3cMqL');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `codeMassar` varchar(30) NOT NULL,
  `id_student` int(11) DEFAULT NULL,
  `cin` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `firstNameArabe` varchar(50) NOT NULL,
  `lastNameArabe` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `sex` varchar(30) NOT NULL,
  `bacYear` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `parentPhone` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `placeBirth` varchar(100) NOT NULL,
  `dateBirth` date NOT NULL,
  `idBac` int(11) NOT NULL,
  `idLycee` int(11) NOT NULL,
  `idCity` int(11) NOT NULL,
  `idRegion` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_expiry_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `statut` int(11) NOT NULL DEFAULT 1,
  `id_responsable` int(11) NOT NULL,
  `id_pack` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `attachment_cin` varchar(255) NOT NULL,
  `attachment_releve` varchar(255) NOT NULL,
  `attachment_diplome` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`codeMassar`, `id_student`, `cin`, `email`, `password`, `firstName`, `lastName`, `firstNameArabe`, `lastNameArabe`, `photo`, `sex`, `bacYear`, `phone`, `parentPhone`, `address`, `placeBirth`, `dateBirth`, `idBac`, `idLycee`, `idCity`, `idRegion`, `token`, `token_expiry_date`, `statut`, `id_responsable`, `id_pack`, `created_at`, `attachment_cin`, `attachment_releve`, `attachment_diplome`) VALUES
('D12345678', 141191356, 'JJ100423', 'mohamedouahki123@gmail.com', 'Cbwih2072', 'MOHAMED', 'mohamed', 'وحقي', 'محمد', 'profile_images/6488863e3e248-images - Copie.jpg', 'ذكر', 2020, '0615893481', '0615893481', 'marrakech,azli', 'marrakech', '2000-10-15', 3, 1, 47, 7, '5d56373efbf7712066f42a073569b2c1', '2023-06-13 16:27:34', 1, 1, 2, '2023-06-13 15:01:38', 'uploads/attachment_student/648898f601f01Certification.pdf', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `siteWeb` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tele` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `youtube` varchar(100) DEFAULT NULL,
  `instagrame` varchar(100) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `QuiSommesNous` text NOT NULL,
  `AproposDuSite` text DEFAULT NULL,
  `smtp_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `website`
--

INSERT INTO `website` (`id`, `siteWeb`, `email`, `tele`, `address`, `twitter`, `facebook`, `youtube`, `instagrame`, `logo`, `QuiSommesNous`, `AproposDuSite`, `smtp_password`) VALUES
(1, 'موقع  توجيه', 'mohamedouahki22@gmail.com', '06168345678', 'Boulevard de Mohammedia. QI Azli 40150 Marrakech Morocco', 'https://twitter.com/AlJisr1/with_replies', 'https://www.facebook.com/AssociationAljisr/', 'https://www.youtube.com/@aljisrtawjih7297', 'https://www.instagram.com/aljisser/?hl=en', '168639826616836555548dede0b54b5140ec82b0c707be1a0bcb-removebg-preview.png', 'الجسر توجيه هي مؤسسة متخصصة في مجال الإعلام و التوجيه المدرسي لفائدة تلاميد السنة الثانية بكالوريا لولوج المدارس  و المعاهد الوطنية العليا', 'موقع توجيه رفيقكم في الإعلام والتوجيه', 'aduiyioyzeszrvbk');

-- --------------------------------------------------------

--
-- Structure de la table `whatsapp`
--

CREATE TABLE `whatsapp` (
  `numWhatsapp` varchar(20) DEFAULT NULL,
  `messageWhatsapp` varchar(255) NOT NULL DEFAULT 'السلام عليكم'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `whatsapp`
--

INSERT INTO `whatsapp` (`numWhatsapp`, `messageWhatsapp`) VALUES
('0615893481', 'السلام عليكم ورحمة الله و بركاته');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_admin` (`id_admin`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article_etr`
--
ALTER TABLE `article_etr`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_etr_id_pays_foreign` (`id_pays`);

--
-- Index pour la table `bac`
--
ALTER TABLE `bac`
  ADD PRIMARY KEY (`idBac`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`idCity`),
  ADD KEY `fk_region` (`idRegion`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comments_students` (`student_CodeMassar`);

--
-- Index pour la table `demande_inscription`
--
ALTER TABLE `demande_inscription`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_demande_pack` (`idPack`);

--
-- Index pour la table `establishments`
--
ALTER TABLE `establishments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lycee`
--
ALTER TABLE `lycee`
  ADD PRIMARY KEY (`idLycee`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `fk_messages_students` (`id_student`),
  ADD KEY `fk_messages_admin` (`id_admin`),
  ADD KEY `fk_messages_responsable` (`id_responsable`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notif`),
  ADD KEY `notification_id_foreign` (`id`);

--
-- Index pour la table `packs`
--
ALTER TABLE `packs`
  ADD PRIMARY KEY (`idPack`),
  ADD KEY `fk_packs_admin` (`id_who_created`);

--
-- Index pour la table `pays`
--
ALTER TABLE `pays`
  ADD PRIMARY KEY (`idPays`),
  ADD UNIQUE KEY `pays_nompays_unique` (`nomPays`),
  ADD UNIQUE KEY `pays_nompaysfr_unique` (`nomPaysFr`);

--
-- Index pour la table `recus`
--
ALTER TABLE `recus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_establishments` (`id_establishment`),
  ADD KEY `fk_student` (`id_student`);

--
-- Index pour la table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`idRegion`);

--
-- Index pour la table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_req_student` (`id_student`(250));

--
-- Index pour la table `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`idRes`),
  ADD UNIQUE KEY `idRes_gen` (`idRes_gen`),
  ADD KEY `fk_responsable_admin` (`id_who_created`);

--
-- Index pour la table `stripe_account`
--
ALTER TABLE `stripe_account`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`codeMassar`),
  ADD UNIQUE KEY `id_student` (`id_student`),
  ADD KEY `fk_city` (`idCity`),
  ADD KEY `fk_region` (`idRegion`),
  ADD KEY `fk_lycee` (`idLycee`),
  ADD KEY `fk_bac` (`idBac`),
  ADD KEY `fk_responsable_student` (`id_responsable`),
  ADD KEY `fk_pack_student` (`id_pack`);

--
-- Index pour la table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `article_etr`
--
ALTER TABLE `article_etr`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `bac`
--
ALTER TABLE `bac`
  MODIFY `idBac` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `idCity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `demande_inscription`
--
ALTER TABLE `demande_inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `establishments`
--
ALTER TABLE `establishments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `lycee`
--
ALTER TABLE `lycee`
  MODIFY `idLycee` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notif` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT pour la table `packs`
--
ALTER TABLE `packs`
  MODIFY `idPack` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `pays`
--
ALTER TABLE `pays`
  MODIFY `idPays` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `recus`
--
ALTER TABLE `recus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `region`
--
ALTER TABLE `region`
  MODIFY `idRegion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `idRes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stripe_account`
--
ALTER TABLE `stripe_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article_etr`
--
ALTER TABLE `article_etr`
  ADD CONSTRAINT `article_etr_id_pays_foreign` FOREIGN KEY (`id_pays`) REFERENCES `pays` (`idPays`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande_inscription`
--
ALTER TABLE `demande_inscription`
  ADD CONSTRAINT `fk_demande_pack` FOREIGN KEY (`idPack`) REFERENCES `packs` (`idPack`);

--
-- Contraintes pour la table `packs`
--
ALTER TABLE `packs`
  ADD CONSTRAINT `fk_packs_admin` FOREIGN KEY (`id_who_created`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `responsables`
--
ALTER TABLE `responsables`
  ADD CONSTRAINT `fk_responsable_admin` FOREIGN KEY (`id_who_created`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
