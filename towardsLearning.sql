CREATE database   if not exists `towardsLearning`;
CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`admin_id`, `Name`, `Email`, `Password`) VALUES
(1, 'Admin', 'admin@email.com', md5('password'));


CREATE TABLE `appointments` (
  `ap_id` int(10) NOT NULL,
  `studentName` varchar(255) NOT NULL,
  `st_id` int(20) NOT NULL,
  `teacher_id` int(20) NOT NULL,
  `time` datetime NOT NULL,
  `teacherName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `blogdata` (
  `blogId` int(10) NOT NULL,
  `blogUser` varchar(256) NOT NULL,
  `blogTitle` varchar(256) NOT NULL,
  `blogContent` longtext NOT NULL,
  `blogTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `blogfeedback` (
  `blogId` int(10) NOT NULL,
  `comment` varchar(256) NOT NULL,
  `commentUser` varchar(256) NOT NULL,
  `commentPic` varchar(256) NOT NULL DEFAULT 'profile0.png',
  `commentTime` timestamp NOT NULL DEFAULT current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `questions` (
  `q_id` int(11) NOT NULL,
  `question_title` mediumtext DEFAULT NULL,
  `question_detail` mediumtext NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_code` int(11) NOT NULL,
  `question_img` varchar(255) DEFAULT NULL,
  `ques_points` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(30) NOT NULL DEFAULT 'Unanswered',
  `likes` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `solutions` (
  `sol_id` int(11) NOT NULL,
  `answer` varchar(256) NOT NULL,
  `Solution` mediumtext NOT NULL,
  `sol_img` varchar(255) NOT NULL,
  `ques_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `Full_Name` varchar(20) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `Rank` varchar(20) NOT NULL,
  `points` int(10) DEFAULT 100,
  `sactive` int(255) NOT NULL DEFAULT 0,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `fcourses` (
  `tid` int(10) NOT NULL,
  `pid` int(25) NOT NULL,
  `product` varchar(25) NOT NULL,
  `pcat` varchar(256) NOT NULL,
  `pinfo` varchar(256) NOT NULL,
  `price` float NOT NULL,
  `pimage` varchar(256) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `mycart` (
  `bid` int(10) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `subjects` (
  `s_code` int(11) NOT NULL,
  `Subject_Name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `review` (
  `pid` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rating` int(10) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO `subjects` (`s_code`, `Subject_Name`) VALUES
(1, 'Finance'),
(2, 'Math'),
(3, 'Physics'),
(4, 'Chemistry'),
(5, 'Economics'),
(6, 'Law'),
(7, 'Computer Science'),
(8, 'History'),
(9, 'Biology');

CREATE TABLE `likedata` (
  `blogId` int(10) NOT NULL,
  `blogUserId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `teacher` (
  `id` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Subject` varchar(30) NOT NULL,
  `Education` varchar(30) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `cv` varchar(255) NOT NULL,
  `status` varchar(200) NOT NULL DEFAULT 'Unapproved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

ALTER TABLE `blogdata`
  ADD PRIMARY KEY (`blogId`);

ALTER TABLE `fcourses`
  ADD PRIMARY KEY (`pid`);

ALTER TABLE `appointments`
  ADD PRIMARY KEY (`ap_id`);

ALTER TABLE `questions`
  ADD PRIMARY KEY (`q_id`);

ALTER TABLE `solutions`
  ADD PRIMARY KEY (`sol_id`);

ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `subjects`
  ADD PRIMARY KEY (`s_code`);

ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `appointments`
  MODIFY `ap_id` int(10) NOT NULL AUTO_INCREMENT;

ALTER TABLE `questions`
  MODIFY `q_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `solutions`
  MODIFY `sol_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `subjects`
  MODIFY `s_code` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `teacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

ALTER TABLE `likedata`
  ADD KEY `blogId` (`blogId`),
  ADD KEY `blogUserId` (`blogUserId`);

ALTER TABLE `blogdata`
  MODIFY `blogId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

ALTER TABLE `fcourses`
  MODIFY `pid` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
ALTER TABLE `likedata`
  ADD CONSTRAINT `likedata_ibfk_1` FOREIGN KEY (`blogId`) REFERENCES `blogdata` (`blogId`);
COMMIT;