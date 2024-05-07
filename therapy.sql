-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 11:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `therapy`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `therapist_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `r_date` date DEFAULT curdate(),
  `r_time` time DEFAULT curtime(),
  `symptom` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `user_id`, `therapist_id`, `date`, `start_time`, `end_time`, `r_date`, `r_time`, `symptom`) VALUES
(66, 1344336179, 409729, '2024-05-01', '09:26:00', '10:11:00', '2024-05-01', '08:24:21', 'I am grieving'),
(67, 125906261, 409729, '2024-05-02', '00:57:00', '01:42:00', '2024-05-01', '08:57:39', 'My mood is interfering with my job/school performance'),
(68, 1288175212, 409729, '2024-05-23', '21:14:00', '21:59:00', '2024-05-02', '18:14:25', 'I struggle with building or maintaining relationships'),
(69, 414959494, 409731, '2024-05-03', '06:15:00', '07:00:00', '2024-05-02', '18:15:14', 'I\'ve been felling depressed'),
(70, 1145988528, 409727, '2024-05-03', '18:41:00', '19:26:00', '2024-05-02', '18:39:48', 'I am grieving'),
(71, 1288175212, 409729, '2024-05-23', '18:55:00', '19:40:00', '2024-05-04', '14:55:12', 'I struggle with building or maintaining relationships'),
(72, 829981669, 409731, '2024-05-09', '05:03:00', '05:48:00', '2024-05-04', '15:03:40', 'I am grieving');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `text` mediumtext NOT NULL,
  `img` varchar(500) DEFAULT NULL,
  `date_published` date NOT NULL DEFAULT curdate(),
  `category` text DEFAULT NULL,
  `poster_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `title`, `text`, `img`, `date_published`, `category`, `poster_id`) VALUES
(4, 'what about this', 'this thing swas', NULL, '2023-08-29', NULL, NULL),
(5, 'Depression During Pregnancy: Millennials Suffer More than Previous Generation', 'Research suggests that 1 in 7 women experience antenatal depression, or depression during pregancy—are you one of them?\r\n\r\n\r\nMillennial women are more likely than their mothers to experience antenatal depression, or depression during pregnancy, according to a JAMA Network Open Study. Prepartum depression is fairly common, affecting between 10% and 15% of pregnant women.¹\r\n\r\n“It’s estimated that about 1 in 7 pregnant women is depressed,” says Katherine L. Wisner, MD, professor of psychiatry and behavioral sciences and obstetrics and gynecology at Northwestern University in Evanston, Illinois. “The depression is a whole-body physiologic disorder that affects the pregnancy.”\r\n\r\nThe signs of depression in pregnancy can range from a loss of interest in pleasant activities and feelings of worthlessness to changes in appetite and fatigue, explains Amy Kranzler, PhD, attending psychologist in the department of psychiatry and behavioral sciences at Montefiore Medical Center/The University Hospital for Albert Einstein College of Medicine in New York City.\r\n\r\n“The symptoms of depression during pregnancy are largely the same as depression that occurs in other times of life,” Kranzler says. “The pregnant woman may also have worries about the delivery of her baby or about her inadequacy as a mother.”\r\n\r\nPregnant women who have anxiety issues, who have an unplanned pregnancy, or who feel stressed about the well-being of the baby are at an increased risk for depression while pregnant, according to Mitchell S. Kramer, MD, FACOG, chairman of the department of obstetrics and gynecology at Northwell Health’s Huntington Hospital in Huntington, New York. “Women who receive fertility treatment are at an increased risk as well,” he says. “They may worry about the effect of the treatment on the pregnancy and they may consider the pregnancy as a ‘premium’ pregnancy.”\r\n\r\nFluctuating hormones, genetic predisposition, history of mental illness, and lack of family or social support can also play a role.²\r\n\r\nThe JAMA Network Open Study comprised a two-generation cohort: mothers (first generation) and their daughters (second generation) who later got pregnant. Some 17% of the first-generation mothers reported experiencing high depression symptoms, while 25% of the second generation reported being depressed while pregnant. The moms in both groups were between the ages of 19 and 24 when they were surveyed.\r\n\r\nWhy would younger moms like those in the JAMA Network Open Study be depressed? “We know that financial stress and inadequate support increase the risk of depression, and younger moms may be less likely to have those financial and interpersonal resources,” Kranzler says. “However, depression during pregnancy can affect women of all ages.”\r\n', NULL, '2023-08-29', NULL, NULL),
(7, 'The Mask', 'She always wore a mask. A mask of happiness, of confidence, of normality. She smiled and laughed and joked with her friends, pretending that everything was fine. She never let anyone see the pain behind her eyes, the tears that threatened to spill, the scars that marked her skin. She never let anyone know how much she hated herself, how much she wished she could disappear, how much she struggled to survive.\r\n\r\nShe was afraid of being judged, of being rejected, of being pitied. She was afraid of being a burden, of being a problem, of being a mistake. She was afraid of being vulnerable, of being exposed, of being hurt. She was afraid of being herself.\r\n\r\nShe always wore a mask. A mask that hid her true feelings, her true thoughts, her true self. A mask that became heavier and tighter with each passing day. A mask that suffocated her, that isolated her, that consumed her.\r\n\r\nShe always wore a mask. Until one day, she couldn’t anymore.\r\n\r\nShe broke down in front of her teacher, who noticed the signs of distress and reached out to help. She confessed to her parents, who hugged her and assured her that they loved her and supported her. She opened up to her friends, who listened and empathized and encouraged her. She sought professional help, who diagnosed her and treated her and guided her.\r\n\r\nShe realized that she was not alone, that she was not hopeless, that she was not worthless. She realized that she had people who cared about her, who understood her, who accepted her. She realized that she had a voice, a choice, a chance.\r\n\r\nShe started to heal, to grow, to change. She started to face her fears, to challenge her thoughts, to express her emotions. She started to discover herself, to love herself, to be herself.\r\n\r\nShe still wore a mask sometimes. But it was a different kind of mask. A mask of creativity, of exploration, of fun. A mask that she could take off and put on as she pleased. A mask that enhanced her, not defined her.\r\n\r\nShe still wore a mask sometimes. But she also learned to show her face.', '1692200625OIG.jpeg', '2023-08-29', NULL, NULL),
(9, 'The Voice', 'He always heard a voice. A voice that whispered in his ear, that echoed in his head, that haunted his dreams. A voice that told him he was stupid, he was ugly, he was worthless. A voice that mocked him, that criticized him, that tormented him.\r\n\r\nHe tried to ignore the voice, to drown it out, to silence it. He listened to music, he read books, he meditated. He sought distraction, he sought comfort, he sought peace. But nothing worked. The voice was always there, louder and meaner and stronger.\r\n\r\nHe hated the voice, he feared the voice, he believed the voice. He hated himself, he feared himself, he believed himself. He isolated himself, he hurt himself, he lost himself.\r\n\r\nHe always heard a voice. Until one day, he heard another one.\r\n\r\nHe heard another voice. A voice that spoke to him, that reached out to him, that cared for him. A voice that belonged to a girl, a girl who sat next to him in class, a girl who noticed him and smiled at him. A girl who said hello to him, who asked him how he was doing, who invited him to hang out with her.\r\n\r\nShe was kind, she was friendly, she was genuine. She was curious, she was funny, she was smart. She was beautiful.\r\n\r\nHe heard another voice. And it changed everything.\r\n\r\nHe started to talk to her, to listen to her, to like her. He started to open up to her, to trust her, to love her. He started to see himself through her eyes, to hear himself through her words, to feel himself through her touch.\r\n\r\nHe realized that he was not stupid, he was not ugly, he was not worthless. He realized that he was smart, he was handsome, he was valuable. He realized that he had a personality, a talent, a purpose.\r\n\r\nHe started to heal, to grow, to change. He started to challenge the voice, to confront the voice, to overcome the voice. He started to find his voice.\r\n\r\nHe still heard the voice sometimes. But it was a different kind of voice. A voice of motivation, of feedback, of improvement. A voice that helped him, not harmed him.\r\n\r\nHe still heard the voice sometimes. But he also heard another one.\r\n\r\nHe heard another voice. And it made him happy.', '1692201678_a71a980f-0d95-4d54-a57b-211182b50c9e.jpeg', '2023-08-29', NULL, NULL),
(10, 'Tao Te Ching', 'What makes a great state is its being (like) a low-lying, down-flowing (stream);—it becomes the centre to which tend (all the small states) under heaven.\r\n\r\n(To illustrate from) the case of all females:—the female always overcomes the male by her stillness. Stillness may be considered (a sort of) abasement.\r\n\r\nThus it is that a great state, by condescending to small states, gains them for itself; and that small states, by abasing themselves to a great state, win it over to them. In the one case the abasement leads to gaining adherents, in the other case to procuring favour.\r\n\r\nThe great state only wishes to unite men together and nourish them; a small state only wishes to be received by, and to serve, the other. Each gets what it desires, but the great state must learn to abase itself.', NULL, '2023-08-29', NULL, NULL),
(11, 'Psychological short stories to reflect', 'We all love stories, not only those that make us dream but also the psychological short stories to reflect that touch our most sensitive fibers. It is no coincidence that for centuries, the great spiritual leaders of the tribes resorted to wise stories to make reflect the rest of the tribe.\r\n\r\nMilton Erickson, an American psychologist and hypnotherapist, realized the enormous power of the psychological short stories and began to apply them in hypnosis and psychotherapy. Erickson realized that the stories come to our subconscious, circumventing the barriers of the conscious mind, so that they can cause a positive change more radical than the best discourse, however logical or stilted it may be.\r\n\r\nThe power of psychological short stories is that they do not try to convince us, so we do not assume a defensive attitude a priori but we show ourselves more receptive, listen to their message and then reflect on it.\r\n\r\nTherefore, reading psychological stories is also a way to prepare ourselves for life and to grow emotionally as they sometimes allow us to understand at once, by insigth, where we are wrong and what we should do to develop inner peace.\r\n\r\nPsychological short stories with wise messages\r\nThe weight of a glass of water\r\nA psychologist was developing a group session when, suddenly, he raised a glass of water. Everyone was waiting for the typical question: “Is it half full or half empty?”\r\n\r\nHowever, he asked:\r\n\r\n– How much does this glass weigh?\r\n\r\nThe answers varied between 200 and 250 grams. The psychologist replied:\r\n\r\n– The absolute weight is not important. It depends on how long I hold it. If I hold it for a minute, it will not be a problem, but if I hold it for an hour, it will hurt my arm. If I hold it one day, my arm will become numb and paralyzed. The weight of the glass has not changed, it is always the same. But the longer I hold it, the heavier and more difficult to bear it becomes.\r\n\r\nMoral: This psychological story reminds us that worries, negative thoughts and resentment are like that glass of water. If we think about them for a while, nothing happens. If we think about them all day, they start to hurt. And if we think about them during the whole week, we will end up feeling paralyzed and unable to do anything. Therefore, we must learn to let go of everything that can harm us.\r\n\r\nThe rock on the road\r\nIn a distant kingdom, a king once placed a large rock in the middle of the main road that led to the kingdom, blocking the way. Then he hid to see what his subjects did when they passed by.\r\n\r\nHe did not have to wait a long time. Soon some of the wealthiest merchants and courtiers of the kingdom passed, who simply surrounded the rock. Many stayed a while in front of the rock complaining and blaming the king for not keeping the roads clear, but none did anything to remove the obstacle.\r\n\r\nAfter a while a peasant arrived carrying a load of vegetables. He stood for a moment observing it and then placed his burden on the ground at the edge of the road. He tried to move the rock with only his hands but could not, so he used a trunk to leverage. After a great effort, he finally managed to push aside the rock.\r\n\r\nAs he bent to pick up his load, he found a bag, just where the rock had been. The bag contained a good amount of gold coins and a note from the king, indicating that it was the reward for who cleared the way.\r\n\r\nMoral: This psychological short story reminds us that overcome obstacles represent an opportunity to grow as people and improve our condition. Many times problems are opportunities to change, to reflect on our ways of doing or even calls for attention. The final result will depend on the way we approach them.\r\n\r\nThe collector of insults\r\nNear Tokyo lived an old samurai who was dedicated to teaching Buddhism to young people. Although he was of an advanced age, there was a legend that he was capable of defeating any adversary.\r\n\r\nOne day, a warrior known for his lack of scruples went through the house of the old samurai. He was famous for provoking his opponents and, when they lost patience and made a mistake, he counterattacked. The young warrior had never lost a battle.\r\n\r\nHe knew the reputation of the old samurai, so he wanted to defeat him and further increase his fame. The disciples of the master opposed but the old man accepted the challenge.\r\n\r\nThey all went to the town square, where the young warrior began to provoke the old samurai:\r\n\r\nHe insulted him and spat in his face. For several hours he did everything he could to make the samurai lose his composure, but the old man remained impassive. At the end of the afternoon, exhausted and humiliated, the young warrior withdrew.\r\n\r\nDisappointed by the fact that their master accepted so many insults and provocations without answering, his disciples asked him:\r\n\r\n– How could you have endured so much unworthiness? Why you did not use your sword, even though you could lose instead of showing yourself as a coward before all of us?\r\n\r\nThe old man replied:\r\n\r\n– If someone comes to you with a gift and you do not accept it, to whom does the gift belong?\r\n\r\n– To who tried to deliver it, of course – replied one of the disciples.\r\n\r\n– Well, the same goes for envy, anger and insults – explained the teacher – When you do not accept them, they still belong to whoever carried them with them.\r\n\r\nMoral: This psychological story teaches us that we must measure our reactions because when we get angry or frustrated with the others, in reality what we are doing is giving them the control. Many people behave like garbage trucks, willing to leave their frustrations and anger where they allow it.\r\n\r\nThe jar of life\r\nA teacher wanted to teach his students something that encourages them to reflect on life. Standing in front of them, he took a large jar from under the table and placed it on it. Then he pulled out a dozen golf balls and began placing them one by one inside the jar.\r\n\r\nWhen the jar was filled to the brim and he could not place more balls, he asked his students:\r\n\r\n– Is this bottle full?\r\n\r\nEveryone said a resounding yes.\r\n\r\nThen he asked them:\r\n\r\n– Are you sure?\r\n\r\nAnd he pulled out a small stone bucket from under the table. He threw them into the jar and moved them, so that the stones were accommodating in the empty space between the golf balls.\r\n\r\nWhen he finished, he asked again if the bottle was full.\r\n\r\nThis time the audience was already guessing what was coming and one of the attendees said aloud: “Probably not.”\r\n\r\nVery well, the teacher answered. He pulled a bucket full of sand from under the table and began throwing it into the jar. The sand settled in the space between the large balls and the small stones.\r\n\r\nOnce again he asked the group: Is this jar full?\r\n\r\nThat time, the students thought it would be full, it was impossible to put anything else!\r\n\r\n– What do you think is the teaching of this little demonstration?\r\n\r\nOne of the students raised his hand and said:\r\n\r\n– The teaching is that no matter how full your schedule is, if you try, you can always include more things.\r\n\r\n– No! – the teacher replied – the teaching is that if you do not put the big balls first, you will not be able to put them in another moment.\r\n\r\nMoral: In life, as in the jar, we must worry about those things or people really important, which represent those golf balls. If we waste our time in trivialities or in projects that do not give us satisfaction or are significant, in the end we run the risk of not having space for the really important things.\r\n\r\nThe problem\r\nA great Zen master was in charge of teaching the young disciples who had arrived at the monastery. One day the guardian of the monastery died and had to be replaced.\r\n\r\nThe teacher gathered all his disciples, to choose the person who would have that honor.\r\n\r\n– I will present you a problem – he said – He who solves it first, will be the new guardian of the monastery.\r\n\r\nHe brought a bench to the center of the room and placed on top of it a huge and beautiful porcelain vase in which was a beautiful red rose.\r\n\r\n– This is the problem.\r\n\r\nThe disciples looked bewildered at what they saw: the sophisticated and rare designs of the porcelain, the freshness and elegance of the flower … What did that represent? What to do? What was the enigma? All were paralyzed.\r\n\r\nAfter a few minutes, a student stood up, looked at the teacher and the other disciples, walked to the glass with determination, removed it from the bench and put it on the floor.\r\n\r\n– You are the new guardian – the master told him, and explained- I was very clear, I told you that you were facing a problem. No matter how fascinating or rare, problems must be solved.\r\n\r\nMoral: This psychological story warns us of the dangers of being stuck in the contemplation of the problem, something that often happens in everyday life, when we remain ruminating about the situation to be solved, postponing the solution, often out of fear. Instead, we should only learn to face them. We must remember that many times the weight of unresolved problems is havier than the consequences of it.', '16922081395lvdjvra.png', '2023-08-29', NULL, NULL),
(12, 'Pandora Effect: Why does curiosity prevail over common sense?', 'The “Pandora effect” has its origin in an ancient Greek myth. Legend has it that the gods set a trap for Epimetheus to punish his brother, the Titan Prometheus, who had stolen their fire to give it to men.\n\nEpimetheus, dazzled by Pandora’s grace and beauty, ignored the promise he had made to her brother Prometheus never to accept a gift from the gods and took her as her life partner. Pandora was carrying a “poisoned gift,” a box given to her by Zeus that she was not to open under any circumstances.\n\nHowever, curiosity won the battle and one day, while Epimetheus was sleeping, Pandora opened the box. When she lifted the lid, all the misfortunes and evils that could affect man escaped and spread throughout the world, from diseases and suffering to wars and famine or feelings such as envy and anger.\n\nWe still retain the curiosity that motivated Pandora to open that box and, just like it happened to her, it also plays tricks on us.\n\nCuriosity motivates us more than security\nCuriosity is positive. Curiosity is what leads us to continue exploring and is at the base of scientific progress. Curiosity is what takes us out of our comfort zone and many times also pushes us to exceed our own limits. Curiosity allows us to continue learning and discover wonderful things. However, it can also play tricks on us.\n\nFor example, in English the word rubbernecking is used to refer to the tendency to stare at car accidents for too long when passing by. A very interesting study sponsored by the UK government on motorway accidents attributed 29% of them to drivers getting stuck going the other way because they were staring at the accident that had happened on the nearby road. Finally, the UK Highways Agency reduced accidents by erecting giant barriers at accident sites to prevent other drivers from being distracted.\n\nThe problem is that we simply have a hard time overcoming curiosity. In a recent study conducted at the University of Chicago, these researchers found that the Pandora effect is still present: We are curious, even if we know the outcome will be negative.\n\nThe researchers gave the volunteers a box containing prank pens that gave a slightly painful but harmless electric shock when the button on top was activated. One group was given pens with a red sticker indicating they would receive an electric shock and a green sticker indicating they were safe. Another group was given a box of pens with a yellow sticker signifying the outcome would be uncertain; that is, it was not possible to know if that pen would discharge.\n\nNext, the researchers told the participants they could take a look at the pens while they waited for the study to begin. The catch was that the experiment had already started and the researchers were actually observing their behavior. Thus they found that, against all logic, those who had the pens with the yellow sticker (uncertain result) were five times more likely to press the button and receive a painful shock than those who were in the group with the sure results (red/green). Curiosity was simply stronger than common sense.\n\nAnd it wasn’t just them. In a second similar experiment, the researchers gave some participants two or three buttons that they could press at any time. In the first case, people had a button that made either a neutral sound (water being poured into a glass) or a negative sound (chalk screeching on a blackboard). The other group had both buttons plus a third option with a 50/50 chance of playing the neutral or negative sound.\n\nIf you’ve ever heard chalk screeching on a blackboard, you’ll probably do everything to avoid it, as it’s one of the most unpleasant sounds. And yet, when that mystery button was available, it generated such curiosity that people clicked it 30% more times than the sure-result buttons.\n\nHow to counteract the Pandora effect?\nWe are victims of the Pandora effect because we do not value the emotional consequences of our actions. That is, we are so determined to satisfy our curiosity that we do not consider the negative result that we could obtain.\n\nIn practice, it is as if curiosity produced a full-fledged emotional hijacking, preventing us from reflecting on the consequences of our actions. We become so obsessed with figuring out what’s going on that our perspective narrows and we can’t see beyond curiosity. It is as if that desire occupied almost everything in our minds, relegating rationality to the background.\n\nThe good news is that we are not completely at the mercy of the Pandora effect. There are different strategies to contain curiosity. For example, we can think about the consequences of our decisions, especially the negative or damaging ones. This cost-benefit analysis technique will help us regain control and act more sensibly.\n\nAnother strategy to mitigate curiosity is to focus on the negative emotions we will experience if we make a certain decision and things go wrong. In this case, we are not fighting the Pandora effect with reason but with emotion itself. Emotions like disgust or fear are deeply aversive, so they are likely to keep our curiosity at bay.\n\n', '1692208236Pandora-Effect-768x480.png', '2023-08-29', NULL, NULL),
(13, 'People who give unsolicited advices', 'Unsolicited advices are our daily bread. They are everywhere. They haunt us in everyday life and on the Internet. There are always “advisers” willing to “give us” their wisdom, people who give advices without asking to the point of being truly invasive or even offensive.\r\n\r\nFrom asking for advice to receiving unsolicited advices\r\nIn everyday life we have to constantly make decisions, from the smallest to the most vital ones. Fortunately, we can turn to other people for advice. We can ask a financial adviser how to invest our savings or ask the waiter to advise us on a dessert. We can also ask our friends for advice about a problem at work or a conflict in the couple.\r\n\r\nHowever, sometimes such advices rains down on us from heaven. Then they stop being helpful and become an intrusion into our privacy. In a certain way, the counselor invades our emotional space by taking himself the right to cross a psychological limit.\r\n\r\nIn fact, although advices are nothing more than subjective opinions that are transmitted to someone with the intention of helping them guide their behavior, deep down they can also be perceived as a negative judgment, since they indicate that that person believes that we are not capable of finding a solution or solve the problem alone.\r\n\r\nA very interesting experiment conducted at Harvard University revealed a paradox about advices: solicited advices are often worse than unsolicited ones, but when people ask for them, they pay more attention, so they tend to be more effective and lead to a change in decisions more frequently. Instead, people feel safer and more confident when they offer unsolicited advices.\r\n\r\nIn fact, psychologists from the University of Singapore found that giving advices makes us feel powerful. These researchers explain that although giving advices may seem – and in fact in many cases is – generous and kind, it also creates an imbalance of power, because it implicitly suggests that the person receiving advices needs something from the person offering them or is not capable to solve the problem. Sometimes, it’s true. We cannot always navigate the complexities of life alone. But other times it’s just a wrong assumption.\r\n\r\nNot even therapists escape this reality. Another study conducted at the University of Maryland found that when therapists provide unsolicited advices, client collaboration and responsiveness decreases immediately afterward. It also revealed that people who give unsolicited advices tend to have an anxious attachment style, which means they are emotionally hypersensitive, overly distressed and often dramatize situations.\r\n\r\nDoing away with unsolicited advices\r\nWhoever gives advices wants to be useful. And many of us (myself included) offer guidance and suggestions with the intention of helping. However, the line between helping and meddling is very fine.\r\n\r\nRepeatedly giving unsolicited advices can end up causing problems in the relationship. They can be perceived as disrespectful and can even convey an air of superiority, because we assume that we know what is best for that person.\r\n\r\nFor that reason, unsolicited advices are perceived more as criticism than help. In fact, they can even undermine people’s ability to figure out what’s best for themselves and solve problems by activating their resources.\r\n\r\nGiving unsolicited advices can also be a very frustrating experience for the giver. When our advice is not accepted or appreciated, we feel upset, hurt or resentful, so it ends up being frustrating trying to “help” the other without seeing the results.\r\n\r\nSo the next time we’re offered unsolicited advices, it’s a good idea to remember that the person is probably just trying to help us. Instead of reacting defensively, it is better to thank them for their concern and set a line by making things clear: “Thanks for your advice, but it is a very personal matter” or “I appreciate your concern, but I don’t need your advice”.\r\n\r\nOn the other hand, before daring to give advices, we must make sure that we have understood what that person needs. Maybe he just needs someone to listen to him. Or a listening ear and understanding shoulder. Maybe he just needs to do catharsis to achieve some mental clarity…\r\n\r\nTherefore, before we rush to “fix” someone’s problems, we should ask ourselves:\r\n\r\nWhy do I want to give advices at this precise moment?\r\n\r\nWould I be empathetic and respectful?\r\n\r\nWhat else can I do that is more useful?\r\n\r\nIs there someone more qualified who can help him?\r\n\r\nDo he has the necessary psychological resources to solve the problem alone?\r\n\r\nOf course, like many things in life, is easier said than done, but asking these questions before offering unwanted advices can save us a lot of misunderstanding and frustration.\r\n\r\nWhat to do if someone asks us for advice?\r\nFinally, if a person asks us for advice, it is important not to feel pressured and get away with the first set phrase that comes to mind – often as bombastic as meaningless. Try to put yourself in their place and understand what they are going through.\r\n\r\nDon’t assume that what was useful to you will also be useful to others. Don’t think that the way you would solve the problem will also work for others. Instead of giving blunt advices, it is better to lend an empathetic ear and try to empower the other. Instead of advising, you can ask: What do you think you can do?\r\n\r\nIn this way, you will not assume what is best for him/her and at the same time you will help him/her find a solution that really fits his/her personality and adapts to his/her situation. After all, we cannot assume that our experiences are valid for others or that our perspective is the correct and only possible one.\r\n\r\nSources:\r\n\r\nPrass, M. et. Al. (2020) Solicited and Unsolicited Therapist Advice inPsychodynamic Psychotherapy: Is it Advised? Counselling Psychology Quarterly; 34(2):  253-274.\r\n\r\nDillon, K. D. (2019) Don’t ask, don’t tell: The problems with soliciting advice. Tesis doctoral: Universidad de Harvard.', '1692210448unsolicited-advices.png', '2023-08-29', NULL, NULL),
(15, 'Committing to someone excessively: the dark side of the most “positive” quality in a couple', 'For a couple relationship to work, love is not enough. We know – or at least we should know. There is a huge list of qualities to add that can vary according to the personality, needs and expectations of each person.\r\n\r\nHowever, there is an essential quality in which the vast majority of people and psychologists agree: commitment. Committing to someone is one of the essential pillars of a relationship, but like everything in life, when commitment is excessive it also has its dark side and can even be surprisingly toxic.\r\n\r\nThe risks of committing to someone excessively\r\nBeing committed to someone, especially in a relationship, is generally seen as a positive thing. However, an excessive level of commitment can be quite detrimental, according to research conducted at the University of Houston.\r\n\r\nThe reason?\r\n\r\nBeing excessively committed to someone can lead us to overestimate the small disagreements, problems and conflicts of the day to day to the point that they get out of our control, even leading to depression and anxiety.\r\n\r\nBut what does it mean to commit to someone excessively? How much is too much commitment in a relationship?\r\n\r\nThese psychologists indicate that overcommitment occurs when a person invests too much self-esteem in the relationship. What does that mean? That the image he has of himself and the value he attributes to himself depends fundamentally on how well the relationship is going. In other words, when the relationship is going well, their self-esteem increases artificially and when it goes badly, it falls to the ground. Obviously, that’s not good – neither for the person nor for the relationship.\r\n\r\nIn psychology, this phenomenon is called “relationship contingent self-esteem,” and according to these researchers, people who decide to commit to someone to such an extent also risk being devastated when something goes wrong, even a small conflict or a perfectly normal disagreement between two people who, although they love each other, are still two different individuals.\r\n\r\nThis means that the wrong type of commitment, especially taken to the extreme of subordinating our value to it, can end up undermining the bond of a couple, in addition to shattering the self-esteem of the person who has tied their self-esteem to that relationship.\r\n\r\nWhen self-esteem depends on the relationship\r\nThe problem with this type of commitment is that the person defines his self-image according to how his partner values or treats him, in such a way that his self-esteem fluctuates according to the love, approval or affection he receives. Obviously, committing to someone to that extent ends up getting us into some very dangerous territory emotionally.\r\n\r\nWhen our worth and self-esteem depend almost exclusively on what our partner thinks or how well the relationship is going, we become extremely vulnerable and more prone to emotional instability. As a result, a no-offend criticism, minor argument, or divergence of opinion can plunge us into utter despair, causing great emotional distress.\r\n\r\nIn fact, these researchers found that overcommitted people with contingent self-esteem felt worse about themselves during negative times in their relationships. It’s like they don’t care what caused the problem or who was responsible, they just feel extremely bad about themselves and blame themselves for what happened. This pattern of reaction makes them very vulnerable to any negative circumstance in the relationship, which increases the risk of suffering from anxiety and depression or reacting with hostility, making the conflict even worse.\r\n\r\nLinking self-esteem to the relationship of a couple can also end up generating an emotional dependency. That person is likely to be willing to sacrifice his own identity and well-being just to maintain the affective bond. Overcommitment can lead him to lose sight of his authentic needs and desires, which can cause frustration and resentment. In addition, in the long term, this excess of commitment is likely to end up damaging the relationship itself, since the other person will feel suffocated by the affective responsibility that the other transfers to him.\r\n\r\nYes to commitment, but good and in its fair measure\r\nIt should be noted that this study does not advocate a lack of commitment. When there is no commitment in a relationship, it will be unstable. When uncertainty appears, security fails and there is no trust, the relationship generates discomfort and dissatisfaction. A relationship without commitment will hardly be able to overcome the challenges that life will throw at it. However, when committing to someone, you have to do it in a healthy way.\r\n\r\nCommitment implies taking care of the other, respecting him and showing a willingness to support and take care of him, but it also implies renegotiating the needs of both so that the relationship really allows us to develop and be better every day. We must avoid the mistake of identifying with the couple relationship because we are much more than that. Therefore, our worth does not depend on the other, but on ourselves. When we bring self-esteem to the relationship, it flourishes. When we feed our self-esteem of the relationship, it withers.\r\n\r\nSource:\r\n\r\nKnee, C. R. et. Al. (2008) Relationship-contingent self-esteem and the ups and downs of romantic relationships. J Pers Soc Psychol; 95(3):608-27.', '1692210564committing-to-someone.png', '2023-08-29', NULL, NULL),
(16, 'Why can’t we read anymore?', 'Last year, I read four books.\r\n\r\nThe reasons for that low number are, I guess, the same as your reasons for reading fewer books than you think you should have read last year: I’ve been finding it harder and harder to concentrate on words, sentences, paragraphs. Let alone chapters. Chapters often have page after page of paragraphs. It just seems such an awful lot of words to concentrate on, on their own, without something else happening. And once you’ve finished one chapter, you have to get through another one. And usually a whole bunch more, before you can say finished, and get to the next. The next book. The next thing. The next possibility. Next next next.\r\n\r\nI am an optimist\r\nStill, I am an optimist. Most nights last year, I got into bed with a book — paper or e — and started. Reading. Read. Ing. One word after the next. A sentence. Two sentences.\r\n\r\nMaybe three.\r\n\r\nAnd then … I needed just a little something else. Something to tide me over. Something to scratch that little itch at the back of my mind— just a quick look at email on my iPhone; to write, and erase, a response to a funny Tweet from William Gibson; to find, and follow, a link to a good, really good, article in the New Yorker, or, better, the New York Review of Books (which I might even read most of, if it is that good). Email again, just to be sure.\r\n\r\nI’d read another sentence. That’s four sentences.\r\n\r\nSmokers who are the most optimistic about their ability to resist temptation are the most likely to relapse four months later, and overoptimistic dieters are the least likely to lose weight. (Kelly McGonigal: The Willpower Instinct)\r\n\r\nIt takes a long time to read a book at four sentences per day.\r\n\r\nAnd it’s exhausting. I was usually asleep halfway through sentence number five.\r\n\r\nI’ve noticed this pattern of behaviour for a while now, but I think last year’s completed book tally was as low as it has ever been. It was dispiriting, most deeply so because my professional life revolves around books: I started LibriVox (free public domain audiobooks), and Pressbooks (an online platform for making print and ebooks), and I co-edited a book about the future of books.\r\n\r\nI’ve dedicated my life one way or another to books, I believe in them, yet, I wasn’t able to read them.\r\n\r\nI’m not alone.\r\n\r\nWhen the people at the New Yorker can’t concentrate long enough to listen to a song all the way through, how are books to survive?\r\nI heard an interview on the New Yorker podcast recently, the host was interviewing writer and photographer, Teju Cole.\r\n\r\nHost:\r\n\r\nOne of the challenges in culture now is to, say, listen to a song all the way through, we’re all so distracted, are you still able to kind of give deep attention to things, are you able to sort of engage in culture that way?”\r\n\r\nTeju Cole:\r\n\r\n“Yes, very much so.”\r\n\r\nWhen I heard this, I felt like hugging the host. He couldn’t even listen to a song all the way through, before getting distracted. Imagine what his bedside pile of books does to him.\r\n\r\nI also felt like hugging Teju Cole. It’s people like Mr. Cole who give us hope that someone will be left to teach our children how to read books.\r\n\r\nDancing to distraction\r\nWhat was true of my problems reading books — the unavoidable siren call of the digital hit of new information — was true in the rest of my life as well.\r\n\r\nMy two-year old daughter, dance recital. Pink tutu. Cat ears on her head. Along with five other two-year-olds, in front of a crowd of 75 parents and grandparents, these little toddlers put on a show. You can imagine the rest. You’ve seen these videos on Youtube, maybe I have shown you my videos. The cuteness level was extreme, a moment that defines a certain kind of parental pride. My daughter didn’t even dance, she just wandered around the stage, looking at the audience with eyes as wide as a two-year old’s eyes starting at a bunch of strangers. It didn’t matter that she didn’t dance, I was so proud. I took photos, and video, with my phone.\r\n\r\nAnd, just in case, I checked my email. Twitter. You never know.\r\n\r\nI find myself in these kinds of situations often, checking email or Twitter, or Facebook, with nothing to gain except the stress of a work-related message that I can’t answer right now in any case.\r\n\r\nIt makes me feel vaguely dirty, reading my phone with my daughter doing something wonderful right next to me, like I’m sneaking a cigarette.\r\n\r\nOr a crack pipe.\r\n\r\nOne time I was reading on my phone while my older daughter, the four-year-old, was trying to talk to me. I didn’t quite hear what she had said, and in any case, I was reading an article about North Korea. She grabbed my face in her two hands, pulled me towards her. “Look at me,” she said, “when I’m talking to you.”\r\n\r\nShe is right. I should.\r\n\r\nSpending time with friends, or family, I often feel a soul-deep throb coming from that perfectly engineered wafer of stainless steel and glass and rare earth metals in my pocket. Touch me. Look at me. You might find something marvellous.\r\n\r\nThis sickness is not limited to when I am trying to read, or once-in-a-lifetime events with my daughter.\r\n\r\nAt work, my concentration is constantly broken: finishing writing an article (this one, actually), answering that client’s request, reviewing and commenting on the new designs, cleaning up the copy on the About page. Contacting so and so. Taxes.\r\n\r\nAll these tasks critical to my livelihood, get bumped more often than I should admit by a quick look at Twitter (for work), or Facebook (also for work), or an article about Mandelbrot sets (which, just this minute, I read).\r\n\r\nEmail, of course, is the worst, because email is where work happens, and even if it’s not the work you should be doing right now it may well be work that’s easier to do than what you are doing now, and that means somehow you end up doing that work instead of whatever you are supposed to be working on now. And only then do you get back to what you should have been focusing on all along.\r\n\r\nDopamine and digital\r\nIt turns out that digital devices and software are finely tuned to train us to pay attention to them, no matter what else we should be doing. The mechanism, borne out by recent neuroscience studies, is something like this:\r\n\r\nNew information creates a rush of dopamine to the brain, a neurotransmitter that makes you feel good.\r\nThe promise of new information compels your brain to seek out that dopamine rush.\r\nWith fMRIs, you can see the brain’s pleasure centres light up with activity when new emails arrive.\r\n\r\nSo, every new email you get gives you a little flood of dopamine. Every little flood of dopamine reinforces your brain’s memory that checking email gives a flood of dopamine. And our brains are programmed to seek out things that will give us little floods of dopamine. Further, these patterns of behaviour start creating neural pathways, so that they become unconscious habits: Work on something important, brain itch, check email, dopamine, refresh, dopamine, check Twitter, dopamine, back to work. Over and over, and each time the habit becomes more ingrained in the actual structures of our brains.', NULL, '2023-08-29', NULL, NULL),
(17, 'This is the one you t', 'People with depression have a higher risk for additional health problems. Does that mean that treating depression might protect these individuals from other chronic conditions? Researchers explored this question by looking at how psychotherapy (talk therapy) may affect a person\'s risk for cardiovascular disease. In psychotherapy, a person works with a therapist to discuss concerns, identify harmful thought patterns, and help manage negative behaviors and emotions. It\'s often used as a first-line treatment for depression. In the study, researchers looked at data on 636,955 people who were free of cardiovascular disease, met specific criteria for depression, and completed a course of psychotherapy. Three years later, patients whose depression symptoms improved after therapy were 12% less likely to have experienced a heart attack or stroke than those whose symptoms were unchanged\r\nPeople with depression have a higher risk for additional health problems. Does that mean that treating depression might protect these individuals from other chronic conditions? Researchers explored this question by looking at how psychotherapy (talk therapy) may affect a person\'s risk for cardiovascular disease. In psychotherapy, a person works with a therapist to discuss concerns, identify harmful thought patterns, and help manage negative behaviors and emotions. It\'s often used as a first-line treatment for depression. In the study, researchers looked at data on 636,955 people who were free of cardiovascular disease, met specific criteria for depression, and completed a course of psychotherapy. Three years later, patients whose depression symptoms improved after therapy were 12% less likely to have experienced a heart attack or stroke than those whose symptoms were unchangedPeople with depression have a higher risk for additional health problems. Does that mean that treating depression might protect these individuals from other chronic conditions? Researchers explored this question by looking at how psychotherapy (talk therapy) may affect a person\'s risk for cardiovascular disease. In psychotherapy, a person works with a therapist to discuss concerns, identify harmful thought patterns, and help manage negative behaviors and emotions. It\'s often used as a first-line treatment for depression. In the study, researchers looked at data on 636,955 people who were free of cardiovascular disease, met specific criteria for depression, and completed a course of psychotherapy. Three years later, patients whose depression symptoms improved after therapy were 12% less likely to have experienced a heart attack or stroke than those whose symptoms were unchanged', NULL, '2023-08-29', NULL, NULL),
(18, 'How To Make A Difference With Your Writing', 'Not every writer is a social justice warrior, and not all of us feel the need to use our writing to make the world a better place. But we all have issues we care about. Problems that concern us. Things we want to change.\r\n\r\nOne of the first books I read about writing, many years ago, was Writing to Change the World, by Mary Pipher. I’ve read it numerous times since. And its message has always stuck with me. If I’m going to put my writing out into the world, why not use it to try and make a difference, in some small way?\r\n\r\nIf you want to change the world, even a little bit, you could start by writing about the issues that bother you. If that appeals to you, here are some things to think about.\r\n\r\nWhat’s the legacy you want to leave?\r\nWe may not spend much time thinking about it, but most of us want to leave a legacy. We don’t want to check out of this life thinking we had no impact whatsoever on the world. If we choose writing as a career, we have the privilege of being able to be creative, earn money and possibly leave a legacy, all at the same time.\r\n\r\nEveryone has different motivations for wanting to write and get that writing published, but most of us write to communicate, share ideas and spread a message. Figuring out what your message is before you start a piece of writing is a way to give your writing clarity, strength and meaning.\r\n\r\n', '1692002415ssss.png', '2023-08-29', NULL, NULL),
(19, 'Talk therapy for depression may help lower heart disease risk', 'People with depression have a higher risk for additional health problems. Does that mean that treating depression might protect these individuals from other chronic conditions? Researchers explored this question by looking at how psychotherapy (talk therapy) may affect a person\'s risk for cardiovascular disease. In psychotherapy, a person works with a therapist to discuss concerns, identify harmful thought patterns, and help manage negative behaviors and emotions. It\'s often used as a first-line treatment for depression. In the study, researchers looked at data on 636,955 people who were free of cardiovascular disease, met specific criteria for depression, and completed a course of psychotherapy. Three years later, patients whose depression symptoms improved after therapy were 12% less likely to have experienced a heart attack or stroke than those whose symptoms were unchanged.\r\n\r\nThe researchers pointed out that improving depression symptoms with therapy does not directly affect cardiovascular disease risk. Instead, they theorized that therapy likely helped people make healthier lifestyle changes, such as adjusting their diet and exercising more, which in turn improved their heart health. The results appeared May 7, 2023, in the European Heart Journal.\r\n\r\n“Knowing what to expect beforehand, even if it doesn’t coincide with your own particular personality, makes it easier when you are not surprised. Roommates will always have to compromise ― so you don’t have to be exactly the same, but there should be no surprises,” said Diane Gottsman, an etiquette expert and founder of The Protocol School of Texas.\r\n\r\nWe asked experts and people with roommates to share the one question they think is vital to ask before living with someone. Here’s what they said:', '1692002656a.jpg', '2023-08-29', NULL, NULL),
(20, 'Krishnamurti on Mental Health', 'HAVING BEEN TABOO for decades, if not centuries, mental health is now being widely discussed. During these exceptional times of pandemic, many of us are confronted with psychological problems related to isolation, anxiety, loneliness, frustrations, addictions, insecurities, depression, fears and worry – issues regularly addressed by Krishnamurti. Throughout his talks and discussions, Krishnamurti reveals that we are conditioned to have problems and that taking them personally may be a fundamental error. Moreover, the realisation that one’s loneliness, for example, is common to all humanity, is essential to understanding it, being free of it and learning what it is to be fundamentally secure and well in an uncertain world.', '1692009327black-and-white-photo-portrait-of-j-krishnamurti-hand-on-his-chin-looking-to-right.jpg', '2023-08-29', NULL, NULL);
INSERT INTO `blog` (`id`, `title`, `text`, `img`, `date_published`, `category`, `poster_id`) VALUES
(21, 'Question: How Do People Become Neurotic?', 'KRISHNAMURTI: How do we know they are neurotic? Please, this is a very serious question. Neurotic – what does that mean? A little odd, unclear, confused, slightly off-balance? Unfortunately, most of us are slightly off-balance. No? You aren’t quite sure! Aren’t you off-balance if you are a Christian, a Hindu, a Buddhist or a communist? Aren’t you neurotic when you enclose yourself with your problems, build a wall around yourself because you think you are better than somebody else? Aren’t you off-balance when your life is full of resistance – me and you, we and they, and all the other divisions? Aren’t you neurotic in the office when you want to be better than another?\r\n\r\nSo, how does one become neurotic? Does society make you neurotic? That is the simplest explanation – my father or mother, my neighbour, the government, the army, everybody makes me neurotic. Are they all responsible for my being off-balance? And when I go to the analyst for help, poor chap, he’s also neurotic like me. Please, don’t laugh; this is exactly what is happening in the world. So why do I become neurotic? Everything in the world, as it exists now, the society, the family, the parents, the children, have no love. Do you think there would be wars if we had love? Do you think there would be governments that consider it is perfectly all right for you to be killed? Such a society would not exist if your mother and father really loved you, cared for you, looked after you and taught you how to be kind, how to live and how to love. These are the outer pressures and demands that bring about this neurotic society. There are also the inner compulsions and urges within ourselves, our innate violence inherited from the past, that help to make up this neurosis, this imbalance.', '1692009373black-and-white-photograph-of-a-young-j-krishnamurti-looking-to-left-holding-a-flower.jpg', '2023-08-29', NULL, NULL),
(22, 'By putting aside an accepted tradition the mind has become free.', 'Another cause of suffering is attachment. I may be attached to you as an audience because you feed me psychologically, and I feel tremendously excited, elevated, so I am attached. Or I am attached to a person, an idea, an opinion, to tradition and so on. Why is the mind attached? Have you ever gone into this? It is attached to furniture or a house, attached to a wife or husband, attached to God knows what. Why? This is one of the reasons for great suffering. And being attached and finding it is painful, we try to cultivate detachment, which is another horror.\r\n\r\nSo why is the mind attached? An attachment is a form of occupation for the mind. If I am attached to you, I am thinking about you; I am concerned about you in my self-centred way because I don’t want to lose you. I don’t want you to be free; I don’t want you to do something which disturbs my attachment. In that attachment, I feel at least temporarily secure. So in attachment there is fear, jealousy, anxiety and suffering. Just look at it, don’t say, ‘What am I to do?’ because you cannot do anything. If you try to do something about your attachment, you create another form of attachment. So just observe it. When you are attached, you dominate that person, you want to control them, and you deny them freedom. When you are attached, you deny freedom altogether.\r\n\r\nSo, seeing loneliness and attachment are causes of sorrow, is it possible for the mind to be free of them? Which doesn’t mean that the mind becomes indifferent. We are concerned with the whole of existence, not just our own existence. Therefore I must respond, answer to the whole, and not my particular little desire to be attached to you to try to get over my anxiety and pain. Our concern is to find this quality of love, which can only come into being when the mind is concerned with the whole and not with the particular. When it is concerned with the whole, there is love, and then from the whole, the particular has a place.\r\n\r\nSo is my mind, your mind, your consciousness capable of looking at this fact, looking at it, seeing what extraordinary misery it causes, not only to another but to oneself? It is only with the ending of suffering that wisdom comes into being. Wisdom is not a thing that you buy in books or that you learn from another. Wisdom comes in the understanding of suffering and all the implications of suffering, not only the personal but also the human suffering, which we have created. Only when you go beyond it does wisdom comes into being.\r\n\r\nPsychologically we human beings are greatly hurt. We have deep wounds, unconscious and conscious wounds, either self-inflicted or caused by others, at school, at home, at work. We are hurt, and that deep hurt, conscious or unconscious, makes us psychologically insensitive and dull. Watch your own hurt, if you can. A gesture, a word, a look is enough to hurt. And you are hurt when you are compared with somebody else or when you try to imitate somebody. When you are conforming to a pattern, you are hurt, whether that pattern is set by another or by yourself. So we human beings are deeply wounded, and those wounds bring about neurotic activity. Is it possible to understand these hurts and be free of them, and never be hurt again under any circumstances? Can these wounds be wiped away without leaving a mark? Watch it, please. Don’t look somewhere else; look at yourself. You have these wounds. Can they be wiped away, not leaving a mark? The other problem is never to be hurt. If there is a hurt, you are not sensitive, and you will never know what beauty is. You can go to all the museums in the world, compare Michelangelo, Picasso and whatever you like, be experts explanations, in the study of these people and their paintings, but as long as a human mind is hurt and therefore insensitive, it will never know what beauty is. And without beauty there is no love.\r\n\r\nOne of the major reasons for suffering is a sense of isolation.\r\nCan your mind know it has been hurt and not react to those hurts at the conscious and unconscious levels? Can it know these hurts, be aware of them? It is fairly easy to be aware of conscious hurts but can you know your unconscious hurts? Or must you go through the idiotic process of analysis? Analysis implies the analyser and the analysed. Who is the analyser? Is he different from the analysed? If he is different, why is he different? Who created the analyser to be different from the analysed? If he is different, how can he know what the thing is? The analyser is the analysed. That is so obvious. To analyse, each analysis must be totally complete. If there is any slight misunderstanding, you cannot analyse completely. Analysis implies time: for the rest of your life you can analyse, and you will be still analysing as you die.\r\n\r\nSo how is the mind to uncover the unconscious, deep wounds, and the wounds the race has collected? When the conqueror subjugates the victim, he has hurt him. That is a racial hurt. The imperialist, the maker of empires, leaves a deep, unconscious hurt on those whom he has conquered. It is there. How is the mind to uncover all these hidden hurts, deep in the recesses of one’s consciousness? I see the fallacy of analysis, so there is no analysis. There is no analysis. Our tradition is to analyse but I have put aside this tradition. So what has happened to the mind when it has denied or put aside, seen the falseness of analysis? It is free of that burden. Therefore it has become sensitive. It is lighter, clearer, and it can observe more sharply. So by putting aside an accepted tradition – analysis, introspection and all the rest of it – the mind has become free. And by denying the tradition, you have denied the content of the unconscious. The unconscious is the tradition – the tradition of religion, the tradition of marriage, the tradition of, oh, a dozen things. And one of the traditions is to accept hurt, and having accepted hurt, analyse it to get rid of it. Now when you deny that, you have denied the content of the unconscious. Therefore you are free of the unconscious hurts. You don’t have to analyse or go through dreams and all the rest of it.\r\n\r\nSo the mind, by observing the hurt and not using the traditional instruments to try to wipe away that hurt, which is analysis, talking it over, you know, all the business that goes on, group therapy or individual therapy, you wipe away by being aware of tradition. When you deny that tradition, you deny the hurt which accepts that tradition. So the mind then becomes extraordinarily sensitive – the mind being the body, the heart, the brain, the nerves. The total thing becomes sensitive. So now the mind is free. It has gone beyond this sense of suffering. It is a mind free from all hurt and therefore never capable of being hurt again, under any circumstances. Whether it is flattered or insulted, nothing can touch it. Which doesn’t mean it has built a resistance. On the contrary, it is excellently vulnerable.', '1692009529flower-2336287_640.jpg', '2023-08-29', NULL, NULL),
(23, 'Is It Possible To Be Free of Suffering?', 'WHAT IS SUFFERING? Why do human beings suffer? This has been one of the great problems of life for millions of years, and very, very few have gone beyond suffering. Those that do become heroes or saviours, or some kind of neurotic leaders, or religious leaders, and there they remain. But ordinary human beings like you and me, we never seem to go beyond it. We seem to be caught in it. We are asking whether it is possible to be really free of suffering.\r\n\r\nThere are various kinds of suffering – the physical and the various psychological movements of suffering; the ordinary pains through disease, old age, ill-health, bad diet and so on, and the enormous field of psychological suffering. Can you be aware of that field? Can you know the structure, nature and function of suffering intimately? How does it operate? What are its results? It cripples the mind and encloses self-centred activity more and more. Is one aware of all that?\r\n\r\nWe are considering psychological suffering, which humanity has not been able to resolve. We have been able to escape from it through various channels – religious, economic, social activity, political activity, business, various forms of escapes, drugs – every form of escape but not confronting the actual fact of suffering. Is it possible for the mind to be completely free of the psychological activity that brings about suffering?\r\n\r\nOne of the major reasons for this suffering is a sense of isolation, which is the feeling of total loneliness, which is to feel that you have nothing to depend upon, a sense that you have no relationship with anyone, that you are totally isolated. You have had this feeling, I am quite sure. You may be with your family, on a bus or at a party, but you have moments of an extraordinary sense of isolation, an extraordinary sense of lack, of total nothingness. That is one of the reasons. And psychological suffering also comes through attachment, attachment to an idea or ideal, to opinions or beliefs, to persons or concepts. Please observe this in yourself. The words are the mirror in which you are looking, which shows your own mind’s operations. So look there.\r\n\r\n', NULL, '2023-08-29', NULL, NULL),
(24, 'By putting aside an accepted tradition the mind has become free.', 'Another cause of suffering is attachment. I may be attached to you as an audience because you feed me psychologically, and I feel tremendously excited, elevated, so I am attached. Or I am attached to a person, an idea, an opinion, to tradition and so on. Why is the mind attached? Have you ever gone into this? It is attached to furniture or a house, attached to a wife or husband, attached to God knows what. Why? This is one of the reasons for great suffering. And being attached and finding it is painful, we try to cultivate detachment, which is another horror.\r\n\r\nSo why is the mind attached? An attachment is a form of occupation for the mind. If I am attached to you, I am thinking about you; I am concerned about you in my self-centred way because I don’t want to lose you. I don’t want you to be free; I don’t want you to do something which disturbs my attachment. In that attachment, I feel at least temporarily secure. So in attachment there is fear, jealousy, anxiety and suffering. Just look at it, don’t say, ‘What am I to do?’ because you cannot do anything. If you try to do something about your attachment, you create another form of attachment. So just observe it. When you are attached, you dominate that person, you want to control them, and you deny them freedom. When you are attached, you deny freedom altogether.\r\n\r\nSo, seeing loneliness and attachment are causes of sorrow, is it possible for the mind to be free of them? Which doesn’t mean that the mind becomes indifferent. We are concerned with the whole of existence, not just our own existence. Therefore I must respond, answer to the whole, and not my particular little desire to be attached to you to try to get over my anxiety and pain. Our concern is to find this quality of love, which can only come into being when the mind is concerned with the whole and not with the particular. When it is concerned with the whole, there is love, and then from the whole, the particular has a place.\r\n\r\nSo is my mind, your mind, your consciousness capable of looking at this fact, looking at it, seeing what extraordinary misery it causes, not only to another but to oneself? It is only with the ending of suffering that wisdom comes into being. Wisdom is not a thing that you buy in books or that you learn from another. Wisdom comes in the understanding of suffering and all the implications of suffering, not only the personal but also the human suffering, which we have created. Only when you go beyond it does wisdom comes into being.\r\n\r\nPsychologically we human beings are greatly hurt. We have deep wounds, unconscious and conscious wounds, either self-inflicted or caused by others, at school, at home, at work. We are hurt, and that deep hurt, conscious or unconscious, makes us psychologically insensitive and dull. Watch your own hurt, if you can. A gesture, a word, a look is enough to hurt. And you are hurt when you are compared with somebody else or when you try to imitate somebody. When you are conforming to a pattern, you are hurt, whether that pattern is set by another or by yourself. So we human beings are deeply wounded, and those wounds bring about neurotic activity. Is it possible to understand these hurts and be free of them, and never be hurt again under any circumstances? Can these wounds be wiped away without leaving a mark? Watch it, please. Don’t look somewhere else; look at yourself. You have these wounds. Can they be wiped away, not leaving a mark? The other problem is never to be hurt. If there is a hurt, you are not sensitive, and you will never know what beauty is. You can go to all the museums in the world, compare Michelangelo, Picasso and whatever you like, be experts explanations, in the study of these people and their paintings, but as long as a human mind is hurt and therefore insensitive, it will never know what beauty is. And without beauty there is no love.', NULL, '2023-08-29', NULL, NULL),
(25, 'The Hare and the Tortoise', 'There was once a hare who was friends with a tortoise. One day, he challenged the tortoise to a race. Seeing how slow the tortoise was going, the hare thought he’ll win this easily. So he took a nap while the tortoise kept on going. When the hare woke up, he saw that the tortoise was already at the finish line. Much to his chagrin, the tortoise won the race while he was busy sleeping.\r\n\r\nMoral of the story:\r\n\r\nThere are actually a couple of moral lessons we can learn from this story. The hare teaches that overconfidence can sometimes ruin you. While the tortoise teaches us about the power of perseverance. Even if all the odds are stacked against you, never give up. Sometimes life is not about who’s the fastest or the strongest, it’s about who is the most consistent.', NULL, '2023-08-29', NULL, NULL),
(26, 'The Fox and The Grapes', 'Once there was a hungry fox who stumbled upon a vineyard. After seeing the round, juicy grapes hanging in a bunch, the fox drooled. But no matter how high he jumped, he couldn’t reach for it. So he told himself that it was probably sour and left. That night, he had to sleep on an empty stomach.\r\n\r\nMoral of the Story:\r\n\r\nMost of us have the tendency to act like the fox. When we want something but think it’s too hard to attain, we make up excuses. We tell ourselves that it’s probably not that great instead of working hard for it.', '1692183104short-stories-with-morals-2.png', '2023-08-29', NULL, NULL),
(27, '70+ Most Inspiring Quotes on Caring for Others', 'We all have a responsibility to care for one another. But in a fast-paced and often chaotic world, it’s easy to get caught up in our own lives and forget about this most basic duty.\r\n\r\nDon’t get me wrong. Most of us know what it means to care for others – being kind, compassionate, and supportive of those around us. We know that caring for others has the power to uplift spirits, mend hearts, and create lasting change. But putting that concept into practice isn’t always easy!\r\n\r\nThat’s why, in this blog post, we’ve rounded up the most inspiring quotes on caring for others from some of the world’s greatest thinkers. From renowned philosophers and humanitarians to beloved authors and influential leaders, these quotes provide insights into the essence and importance of looking beyond our own interests. \r\n\r\nMay these words inspire you to embrace the innate human capacity for compassion and empathy. May they also remind you that through our interactions and connections, we can shape the world around us.\r\n\r\nQuotes on Caring for Loved Ones\r\nIt is an absolute human certainty that no one can know his own beauty or perceive a sense of his own worth until it has been reflected back to him in the mirror of another loving, caring human being. – John Joseph Powell\r\nWhen people cared about each other, they always found a way to make it work. – Nicholas Sparks\r\nThe right mixture of caring and not caring – I suppose that’s what love is. – James Hilton\r\nIf we give our children sound self-love, they will be able to deal with whatever life puts before them. – Bell Hooks\r\nTaking care is one way to show your love. Another way is letting people take good care of you when you need it. – Fred Rogers\r\nSome people care too much. I think it’s called love. – Winnie the Pooh\r\nTo care for those who once cared for us is one of the highest honors. – Tia Walker\r\nPeople who care about each other enjoy doing things for one another. – Ann Landers\r\nLive so that when your children think of fairness, caring, and integrity, they think of you. – H. Jackson Brown, Jr.\r\nLeadership is not about being in charge. Leadership is about taking care of those in your charge. – Simon Sinek\r\nTrue love blooms when we care more about another person than we care about ourselves. That is Christ’s great atoning example for us, and it ought to be more evident in the kindness we show, the respect we give, and the selflessness and courtesy we employ in our personal relationships. – Jeffrey R. Holland\r\nThe object of love is not getting something you want but doing something for the well-being of the one you love. – Gary Chapman\r\nThere is always something to do. There are hungry people to feed, naked people to clothe, sick people to comfort and make well. And while I don’t expect you to save the world I do think it’s not asking too much for you to love those with whom you sleep, share the happiness of those whom you call friend, engage those among you who are visionary and remove from your life those who offer you depression, despair and disrespect. – Nikki Giovanni\r\nQuotes About Caring and Kindness for Others\r\nSometimes it takes only one act of kindness and caring to change a person’s life. – Jackie Chan\r\nBeginning today, treat everyone you meet as if they were going to be dead by midnight. Extend to them all the care, kindness, and understanding you can muster, and do it with no thought of any reward. Your life will never be the same again. – Og Mandino\r\nOne person caring about another represents life’s greatest value. – Jim Rohn\r\nToo often we underestimate the power of a touch, a smile, a kind word, a listening ear, an honest compliment, or the smallest act of caring, all of which have the potential to turn a life around. – Leo Buscaglia\r\nBe nice to each other. You can make a whole day a different day for everybody. – Richard Dawson\r\nSo when you are listening to somebody, completely, attentively, then you are listening not only to the words but also to the feeling of what is being conveyed, to the whole of it, not part of it. – Jiddu Krishnamurti\r\nKindness can transform someone’s dark moment with a blaze of light. You’ll never know how much your caring matters. Make a difference. – Amy Leigh\r\nA smile is a light in your window that tells others that there is a caring, sharing person inside. – Denis Waitley\r\nWhy should I care when no one else does? For the simple reason that the most critical time to care is when no one else does. – Craig D. Lounsbrough\r\nFriendly people are caring people, eager to provide encouragement and support when needed most. – Rosabeth Moss Kanter\r\nI expect to pass through life but once. If therefore, there be any kindness I can show, or any good thing I can do to any fellow being, let me do it now, and not defer or neglect it, as I shall not pass this way again. – William Penn\r\nIf you wish to experience peace, provide peace for another. If you wish to know that you are safe, cause another to know that they are safe. If you wish to better understand seemingly incomprehensible things, help another to better understand. If you wish to heal your own sadness or anger, seek to heal the sadness or anger of another. – Dalai Lama\r\nIf we could look into each other’s hearts and understand the unique challenges each of us faces, I think we would treat each other much more gently, with more love, patience, tolerance, and care. – Marvin J. Ashton\r\nWe must all try to empathize before we criticize. Ask someone what’s wrong before telling them they are wrong. – Simon Sinek\r\nDeveloping concern for others, and thinking of them as part of us, brings self-confidence, reduces our sense of suspicion and mistrust, and enables us to develop a calm mind. – Dalai Lama', '1692183197quotes-caring-others-1.png', '2023-08-29', NULL, NULL),
(28, 'Ethiopia: News - Tigray Interim Administration Requests Urgent Assistance to Combat Devastating Desert Locust Swarm', 'the people of Tigray, friends, the federal government, and the international community to offer their support in facing this colossal challenge. \"Urgent measures need to be taken, particularly in the neighboring Afar regions where the locusts originate,\" he said.\r\n\r\nTree locust swarms pose a perilous threat to the already vulnerable agricultural communities in Tigray. The devastating aftermath of ', NULL, '2023-08-29', NULL, NULL),
(29, '10 Lines Short Stories With Moral Lessons for Kids', 'When trying to impart an important moral lesson to kids, short stories are often the go-to for most parents. It not only tickles their imagination, but it also teaches them about life.\r\n\r\nShort stories have a way of teaching lessons that makes them more relatable and interesting. Rather than just telling your kid not to lie, relating a short story about it helps them understand what happens when they lie. It helps them become more aware of their actions and their consequences. The moral lessons from these stories also help shape their character and moral compass as they grow old.\r\n\r\nHere are 10 short stories with moral lessons that your kids (and even some adults) will learn a thing or two from:', '1692182965Short-Stories-With-Moral-Lessons-for-Kids.png', '2023-08-29', NULL, NULL),
(30, 'kk', 'mmmmmmmmmmmmmmmmmm', NULL, '2023-08-29', NULL, NULL),
(31, '7 Ways to Experience Inner Peace', 'Finding balance between digital consumption, mindset, and quiet time is key.\r\n\r\nHas modern technology and your ability to access infinite amounts of information and entertainment brought less stress or more stress into your life?\r\n\r\nSure, we can buy everything we want online—clothes, computers, and cars—and yes, it’s convenient. But has it made our lives more peaceful?\r\n\r\nEmotional energy\r\nMost of us would agree that emotional energy has become a precious commodity in our lives. When we feel emotionally depleted, then anxiety and stress are the natural by-products. Left unchecked, stress can lead to feelings of being out of control.\r\n\r\nAs a result, stress can prompt us to seek temporary relief in unhealthy habits that create more stress in the long run. Turning to alcohol, comfort food, or overspending might provide temporary relief and distraction, but these things greatly complicate our lives.\r\n\r\nControlling your stress\r\nNot everything that causes us stress can be eliminated—nor should it. Low-level stress stimulates the brain to boost productivity and concentration. It can also be a big motivator to make changes, solve problems, or accomplish goals.\r\n\r\nIn addition, many sources of stress are simply beyond our control. It’s become so commonplace for people to feel stressed and overloaded that we tend to forget there is an alternative way to live.\r\n\r\nIt’s time to slow down and consider ways to bring more peace to your heart and soul. Start with these seven ideas:\r\n\r\n1. Beware of peace pickpockets.\r\nYou encounter all kinds of people and situations that try to steal your serenity. Know what they are and take measures to fend them off.\r\n\r\n2. Take a mental health day, or morning, or moment.\r\nWhatever time you can allow, give yourself the space to refresh your mind and spirit.\r\n\r\n3. Rethink your “should do” and “ought to do” lists.\r\nIf the voice in your head is guilting you into doing things that don’t bring you joy, regard these as prime candidates to delete.\r\n\r\n4. Kick the approval habit.\r\nIt’s natural to want to be liked by others—and it’s healthy to accept that it’s not going to happen all the time.\r\n\r\n5. Be still.\r\nIf your pace is wearing you out, set aside a half-day or a full day to sit on the sofa to think, journal, read, and nap.\r\n\r\n6. Let the music move you.\r\nFew things are as cathartic and cleansing as your best-loved music. Use your favorite tunes to calm you down, pump you up, or stir your emotions.\r\n\r\n7. Give yourself a quality-of-life checkup.\r\nIt’s wise to periodically assess whether you’re satisfied with the quality of your life. If you don’t feel fulfilled, ponder what changes are in order.\r\n\r\nInner peace is a worthwhile goal. In today\'s saturated world, having an inner peace plan—and working on it every day—is a good way to ensure you attain that goal.', '1693025161OIP.jpeg', '2023-08-29', NULL, NULL),
(32, 'Why Is It So Common to Not Like a Person You Love?', 'Have you wondered why it\'s easier to love someone than like them?\r\n\r\nHave you ever considered that some of the people you love are not people you like? How can that be?\r\n\r\nI will not presume to define what it means to love someone, other than to suggest that loving a person implies that we care about them and want them to be happy. We hold a fond place in our heart that appreciates them and we value the good things about the relationship.\r\n\r\nWhat does it take to like someone?\r\nIt may sound strange, but it is often easier to love someone than to like them. Love can exist apart from our daily interactions with a person. When we think about them, we might feel a warm glow in our heart. We might experience affection, caring, and kindness toward them. But if we spend more than an hour with them, or perhaps more than two minutes, we might wonder why we scheduled so much time together.\r\n\r\nConsider your relationship with your parents or siblings. Perhaps you have been blessed with ones who are understanding, kind, and supportive. If so, you might love them and like them. You enjoy their company, relish your time together, and look forward to calling them or visiting them on your vacation. If so, you are very blessed indeed!\r\n\r\nBut so often I hear stories from friends and from clients that they have fraught relationships with their relatives. They love them, but the relationship is far from nurturing. After a visit or phone call, they’re left feeling drained and depleted. They need ample recovery time. They may vow to spend less time together in the future. But their love and caring may later override that vow, until they’re reminded once again of how they just don’t like this person.\r\n\r\nIf this resonates with you, perhaps a relative, friend, or even your spouse may come to mind who you care about and love. But you just can’t handle being around them for very long.\r\n\r\nWe all have a need to be heard, valued, and supported. We long for a sense of ease with someone. Yet we never seem to get there with them. Oftentimes, the people closest to us have their own agenda for us. They may care about us, but they want us to be happy on their terms by telling us what to do, feel, or think. Or they\'e so consumed by their own concerns and worries that they don’t have much bandwidth to attend to our feelings, needs, and concerns. As we begin to talk about ourselves, they may quickly turn the conversation toward themselves.\r\n\r\nIngredients Necessary to Like Someone\r\nThe foundation for liking someone is feeling emotionally safe with them. We feel comfortable talking with them or being quiet together; there\'s no pressure to keep the conversation going. We don’t feel compelled to guard our words or defend ourselves. We find it easy to be present with them. We can be serious, as well as lighthearted and humorous. We feel happy, engaged, and delighted being in their presence. A spontaneous delight being with a partner, friend, or relative is a telltale sign that we like them.\r\n\r\nWe tend to like people who are emotionally healthy, who have a high degree of self-worth and self-regulation, a pleasant disposition, and self-confidence without being arrogant and controlling. It’s more difficult to like people who are emotionally challenged. Without a healthy capacity for self-regulation, people are more likely to lash out with anger, sarcasm, and blaming. They are more prone to act out their feelings rather than express them in a non-violent, non-threatening way. People who are self-absorbed, consumed by shame, inauthentic, overly talkative without reciprocating by extending attention toward our world, or unwilling to show vulnerability are more challenging to like.\r\n\r\nThere may be more complexity as to why you might not like a person. Perhaps they embody a vulnerability that unsettles you because you have an aversion toward your own vulnerability. Perhaps they are more accomplished than you and you feel intimidated by them. Perhaps they remind you of a parent or former partner who you dislike. Or maybe they seem self-righteous and remind you too much of your own distasteful self-righteousness. Perhaps you dislike a friend who separated from their partner; you might actually be jealous because some part of you would like to do the same. As you uncover these shadowy aspects of why you don\'t like someone, something might shift inside you—and then between you.\r\n\r\nI’m not suggesting that you eliminate people who you don’t like; it’s a blessing to have people in your life who you love and appreciate. But I do suggest that you stay open to connecting with people with whom you experience a spontaneous delight—and importantly, cultivating those qualities that you do like about others within yourself.\r\n', '1693025486couple-portrait-jeans-april82022-1024x684.png', '2023-08-29', NULL, NULL),
(33, 'When Should You Follow Your Sixth Sense?', 'It\'s a tiny-but-intense feeling. You just met The One, or you\'ve just met a potentially shady character. Is your impression correct? It\'s a mysterious package, delivered to you by subtle sensory clues.\r\nDiscerning Friend From Foe\r\nWe must never ignore clues that something is wrong.\r\n\r\nBy Joe Navarro\r\n\r\nFor most of human history, we have been very good observers because we had to be. We used all of our senses—touch, smell, taste, hearing, and sight—to detect and discern. The sudden vocalization of animals or the scampering of birds alerted us that someone was approaching. Even the sweat of a sojourner let our ancestors know who was in the area and what they had eaten. At a distance, by examining posture, gait, arm swing, clothing, and accouterments (weapons, water vessels) our ancestors could discern friend from foe.\r\n\r\nAs generations evolved and eventually moved to cities, close proximity changed how we viewed and assessed each other. Because everyone was so close, we had less time to observe. Close quarters and circumstances dictated we interact on first meeting rather than later. This was the opposite of what we had done for thousands of years, which was to assess first at a distance and then interact. Close proximity also made us more sensitive to being observed, which is why we are uncomfortable when others stare at us.\r\n\r\nHave we allowed ourselves to become careless when it comes to our own safety and that of our loved ones? I see people distracted while driving (applying makeup or texting). Or someone knocks at the front door and we open it without first seeing who is there and asking what they want. Perhaps, in an attempt to be polite, we have abrogated our responsibility to ourselves, and each other, to be good observers.\r\n\r\nI saw a young person pushing a shopping cart and talking on her phone without staying alert. As she reached her car and opened the door, she found herself trapped by someone begging for money, so close that her expression showed surprise and fear. Fortunately, the man just wanted a handout, but he could have been a sexual predator or a thief. Had she been observing her environment, she could have better anticipated this event.\r\n\r\nWe should all look around and listen to our inner voice, which is in fact the limbic brain telling us to be careful that something is wrong, as security specialist Gavin de Becker pointed out in The Gift of Fear. So often, after an encounter or a relationship turns problematic, one hears, “You know I had a feeling, in the beginning, that something wasn’t right.”\r\n\r\nFailure to observe, if we are honest, leads to avoidable circumstances as well as accidents. How we feel about something often completes the picture so that we can fully understand it. While doing research for my book Dangerous Personalities I talked to hundreds of victims and invariably they said: “I should have listened to my gut. I knew something wasn’t right about that guy. I just could not point to any one thing.”\r\n\r\nPersonally, I am alive today because, as both a police officer and an FBI agent, I encountered many situations where something spoke to me, from the gut, that said, “Don’t go in the building, not now, wait for backup.” And had I gone in the building on my own, I would have been shot by a wanted fugitive. You just never know. I can’t explain it. But we evolved to have immediate reactions to the smallest of sensory inputs. Don’t get me wrong, I worked hard at developing my observation skills, but I have been humble enough to listen to my gut or the hairs on my neck that predicted danger.\r\n\r\nIt is never too late to start observing. Observation is not about being judgmental, it is not about good or bad. It is about seeing the world around you, having situational awareness, and interpreting what it is that others are communicating both verbally and nonverbally. To observe is to see but also to understand, and that requires listening to how you feel.\r\n\r\nGood observation skills give us the opportunity to test and validate what others think, feel, or intend for us. Are they kind, unselfish, and empathetic? Or are they selfish, cruel, indifferent, and apathetic? When we discover who they are early enough, we have spared ourselves or, some might even say, saved ourselves. Being observant does not mean being obnoxious or intrusive. In fact, a good observer knows that intrusive observations affect what is observed; subtlety, as well as purpose, is required.\r\n\r\nTwo Things We Look For\r\n\r\nFinally, what do we in fact assess for? There are many things, but if you get these two right, you will be spared a lot of headaches. Assess for danger and comfort.\r\n\r\nAsk yourself, “How does this situation or this individual make me feel?” For example, you are walking to your car at night and you see someone out of the corner of your eye walking briskly and you sense that you will cross paths. Your limbic brain senses this for you and lets you know something is not right. That discomfort is your brain saying “Warning, possible danger!” If you are to heed that inner voice, you become more alert, look for a well-lit area, and wisely change your pace or return to safety.\r\n\r\nOnce, while working in Yuma, Arizona, I was given the address of a woman who might know the suspect in a state trooper shooting. She was agreeable enough when she answered the door, but something just didn’t feel right. Every time I asked if Alex, the suspect, could be using her apartment to sleep while she was at work, she would place her fingers at the base of her neck. She did that enough times during our conversation, and only when I mentioned Alex using her apartment, that it made me want to ask more questions. Finally, I asked her if I could do a quick search of the house; sure enough, Alex was hiding in the closet with a gun in his hand. I just remember my gut talking to me way before I made a conscious observation, and I am glad that it did.\r\n\r\nAssessing for comfort can open your eyes to subtleties about the person with whom you are dealing. When you are with someone new, ask yourself, “Does this person make me feel comfortable at all times?” If not, then why? We must never ignore clues that say something is wrong, no matter how badly we want a friendship to work. Your subconscious is always working to protect you. It exists for a reason, but you have to be prepared to observe and recognize what you sense.\r\n\r\nObservation is no less important today than it was 10,000 years ago. The only difference is that now we have to do it more quickly and more efficiently because we may run into 50 strangers in a day, whereas our ancestors saw but a few. We can improve this skill, and we can even teach it to our children, but like everything else, it takes effort.\r\n\r\nJoe Navarro is a former FBI counterintelligence agent and the author of What Every Body Is Saying.\r\n\r\n', NULL, '2023-08-29', NULL, NULL),
(34, 'What Is Therapy?', 'Psychotherapy, also called talk therapy or usually just \"therapy,\" is a form of treatment aimed at relieving emotional distress and mental health problems. Provided by any of a variety of trained professionals—psychiatrists, psychologists, social workers, or licensed counselors—it involves examining and gaining insight into life choices and difficulties faced by individuals, couples, or families. Therapy sessions refer to structured meetings between a licensed provider and a client with a goal of improving some aspect of their life. Psychotherapy encompasses many types of treatment and is practiced by a range of clinicians using a variety of strategies. The critical aspect is that the client or patient works collaboratively with the therapist and can identify improvement and positive change over time.\r\n\r\nMost therapies in wide use have been well-tested and deemed effective. Though it may at first feel difficult to seek out therapy—especially for those of low-income or without comprehensive insurance—the benefits of successful therapy are literally life-changing.\r\n\r\nShould I go to therapy?\r\nMost people, regardless of their specific challenges, can benefit from having an impartial observer listen and offer guidance. Because of therapy’s cost and time investment, however—as well as lingering stigma surrounding mental health—the decision to begin therapy isn’t always an easy one.\r\n\r\nTo determine whether therapy is the right choice for a particular individual, they should consider whether they feel sad, anxious, overwhelmed, or irritable more often than not; if yes, therapy would likely offer emotional support and help them develop the tools to manage their mental health. But strong negative emotions aren’t the only reason someone should seek therapy. If they are struggling with relationship challenges, feel stuck in their career, find themselves turning to drugs, alcohol, or food to cope with unpleasant events, or feel disconnected from the people around them, they may find therapy to be immensely helpful.\r\n\r\nWhat type of therapy is right for me?\r\n\r\nMany types of therapy have been shown to be effective at treating common mental health challenges, and determining which approach is “best” for a particular person often comes down to their particular concerns, the alliance they’re able to form with their therapist, and their personal preferences. Clients who are coming to therapy with specific mental health concerns—such as obsessive compulsive disorder or post-traumatic stress—may benefit most from a clinician who specializes in the area or who employs a type of therapy specifically designed to treat it.\r\n\r\nThose seeking help with relationship or family problems may benefit from marriage and family therapy, couples therapy or couples counseling.\r\n\r\nThose seeking a potentially more affordable type of therapy, or for whom it could be beneficial to attend therapy with others who have similar experiences, may wish to consider group counseling or group therapy.\r\n\r\nWill I be able to afford therapy?\r\n\r\nThe cost of therapy, and whether it can fit into a client’s budget, will likely depend on a few factors, including the individual’s insurance coverage, their location, and their income. While some therapists charge a set fee per session, others offer a sliding scale based on clients’ income. In many locations, low- or no-cost therapy is available for low-income clients, often through universities or other therapist training programs. Prospective clients should verify their insurance coverage, along with the therapist’s fee structure, before setting up an appointment.\r\n\r\nWhat will the first session of therapy be like?\r\n\r\nThe first session of therapy can be anxiety-provoking, and it’s normal to feel nervous or unsure of what to expect. Luckily, most patients will find that the first session of therapy follows a predictable format. Most therapists spend the first session asking general questions to get a sense of the client’s background, their past experience with therapy, and what issues they’re hoping to address. They will also likely discuss their own modality or style and offer an outline of what the client can expect. Logistical details, such as verifying insurance coverage and setting up a payment schedule, may happen in the first session as well.\r\n\r\nWill I receive medication if I go to therapy?\r\n\r\nMedication is often used in conjunction with psychotherapy—particularly for cases of severe depression, anxiety, or bipolar disorder—but it’s not a given for every client. If a therapist thinks a particular client could benefit from medication, he or she will discuss it with the client before referring him or her to a prescribing professional such as a psychiatrist or nurse practitioner. While the client will likely need to attend periodic meetings with the prescribing professional to discuss any side effects and dosage adjustments, they will also continue to see the therapist to build coping skills and strategies to further support their mental health.\r\n\r\nWhat are the red flags of an unqualified or unethical therapist?\r\n\r\nEven the best therapists aren’t perfect, and it’s possible for effective, ethical therapists to make mistakes or inadvertently upset a client. But there are some therapists, unfortunately, who are not suited to the profession. Common warning signs of an ineffective therapist include talking too much—to the point where the client feels unable to talk about their own concerns—or sharing inappropriate details about their own personal life. Therapists who are judgmental or condescending to the client are also likely not good fits, as are therapists who frequently appear bored or distracted.\r\n\r\nUnethical therapists are much rarer than unqualified or ineffective ones, but they certainly exist. An unethical clinician may make sexual or romantic overtures toward a client, threaten or blackmail them, or breach confidentiality agreements without just cause. Clients should report such therapists to their licensing board and end therapy as soon as possible.|\r\n\r\nWhen does therapy end?\r\n\r\nTherapy typically ends when the client feels they have achieved their goals or when they feel they are no longer making progress; in some cases, logistical issues, such as changing insurance coverage, necessitate the end of therapy. Alternatively, it is possible for a therapist to determine that they are not the best practitioner to aid a particular client. When this occurs, the therapist will typically refer the client to another provider, where they can continue work if they so choose.\r\n\r\n', '1693026218OIP (1).jpeg', '2023-08-29', NULL, NULL);
INSERT INTO `blog` (`id`, `title`, `text`, `img`, `date_published`, `category`, `poster_id`) VALUES
(114, 'Do Flamethrowers Belong In The Library?', 'We lose people all the time. It’s just the nature of the job. What can you expect from a place full of nooks and crannies people intentionally go to get lost in?\r\n\r\nI usually don’t worry when I don’t see someone for a while, but when it’s been days since someone’s checked out, it’s usually a sign that I need to step in.\r\n\r\nI’m not doing this alone, thankfully. No Librarian is ever truly alone, are they?\r\n\r\nI have help from the Watchers and Listeners of the shelves. Thanks to them, it usually doesn’t take long to get the scent, if you know what I mean. However, today is one of the rare, and unfortunate, exceptions when my search has exceeded more than an hour—and an hour is pushing it.\r\n\r\nI’ve been searching and asking around for almost six hours, scouring shelves and listening for the telltale breathing.\r\n\r\nThe Watchers have their quadrants, so it’s much like playing hot and cold.\r\n\r\n“Bad news.” One says, and my brain shivers in my skull, both from its existence and its statement. \r\n\r\n“They crossed the tape.” Says the Watcher, and I groan. “Are you sure?” My stomach still drops at the thought, even though I’ve been doing this a very long time (long enough that I remember every book on every shelf better than my own child’s face), but knowing a poor soul lost themselves beyond the tape… I grieve for them.  \r\n\r\nThe Watcher doesn’t speak, but generates an affirmative sensation. That means I have to backtrack to my desk for supplies. I thank them, asking that they send word ahead of my arrival.\r\n\r\nIt’s been a while since I’ve had to go past the tape, which means it’s been a while since I entered the broom closet. The helmet is dusty (it looks almost like it’s from one of those old-fashioned scuba diving suits. It’s not nearly so heavy, though.)\r\n\r\nThere’s a bright lamp affixed to the front just above the visor, but it’s as much of a hindrance as a help. While, most of the time, those beyond the tape know not to bother me, some still get bored enough to try—and the lamp acts like a beacon. I don’t blame them, it’s what prisoners do. Find the weakest among them and test their mettle.\r\n\r\nI’ve got a sack full of non-perishables, tinctures, aspirin, and a compass (not like the kind you’re used to, but would take too long to explain—and time is of the essence, so I’ll let your imagination handle it from here.) \r\n\r\nI sling the sack across my body, and fasten my waist with a utility belt that would make a trust fund bat character with abandonment issues jealous. It’s got floss, lighters, matches, and a few more tools that don’t exist outside of The Library. \r\n\r\nThe last thing I grab is the flamethrower.\r\n\r\nThis is where I should be very transparent with you. I’m not actually the Librarian. I’m the Librarian’s Assistant. I know, isn’t that just your luck, right?\r\n\r\nNot to worry, I’m very good at using this thing, and it does the job nicely—whatever job I may deem necessary at any particular moment. But the Head Librarian doesn’t really need much of anything to ward off what lingers here.\r\n\r\nI don’t know exactly where he is at the moment, nor do I want to know. If this were a real pickle I would summon him, but while a rare occasion, it’s not unusual in the scope of a thousand years. After all, no one comes here without the intention (whether it’s conscious or subconscious) to get lost. It’s the nature of this place.\r\n\r\nBut you know that, don’t you? \r\n\r\nIt’s why you’re here, after all.\r\n\r\nIt doesn’t take me long to find the tape, which is fortuitous. Sometimes it moves around, but the Watchers and Listeners kept a beat on it this time so as to direct me.\r\n\r\nYes, it is really dark.\r\n\r\nYes, it’s literal tape. Hazard tape, but that’s almost like a beacon to the adventurous, isn’t it? I think The Library knows that. It’s greedy, but it’s also quite discerning in taste.\r\n\r\nIn some circles that means that I should extend congratulations to you… in others, I offer my sincerest sympathy.\r\n\r\nI hear my name and ignore it as I crawl through the crisscross of reflective strips.\r\n\r\nThe tape moves not at random, by the way. It genuinely serves as a warning.\r\n\r\nWhether it’s gatekeeping sections currently under construction, in repair, or missing. I try not to, but I think that last one has something to do with where the Head Librarian went.\r\n\r\nDon’t worry about it, my name is not important. \r\n\r\nSo ineffectual that I’ve forgotten.\r\n\r\nI hear my name again as I begrudgingly turn on the lamp. Not a lot of help, just enough light to ensure I don’t trip over anything, or disturb the shelves. \r\n\r\nMany sleep here.\r\n\r\nI send off a warning shot from the flamethrower. Showing I carry more light than just atop my appetizing head. The flash of flames sends things… slithering. But most of those this close to the tape have never been very convicted by nature, so I’m not concerned. \r\n\r\nThere are more Listeners and less Watchers past the tape, for obvious reasons. Thankfully, they say I don’t have to go too far. I look down at the telling clicking sound to see rocks rolling. Some as big as my foot, and some as small as the tip of my thumb. The smaller ones move more easily, but all are rolling as if pulled toward a central point. I don’t even need the compass, but I glance down at it one more time before stuffing it back into the sack.\r\n\r\nWhile I don’t have to go too far, things are… relative here. Ten steps may be ten thousand. And so even after only a few moments of exploring, I feel acute pressure jamming into my temples. My heart feels like it’s being squeezed, and my vision blurs. My fingers tingle by the time I’m able to shake the aspirin into my mouth.\r\n\r\nI chew it, ignoring the sound of my name—my true name. The one only I can hear. You’ll hear your own as well, if you stay here long enough.\r\n\r\nMy vision clears, which just means the dark looks sharper, and I sweep another warning arc from the flame thrower for good measure. \r\n\r\nI do this as much because I love the sound as for protection. I also appreciate the warmth. It gets cold here. But in a strange way, which shouldn’t surprise you at this point. \r\n\r\nIt’s cold like how the first signs of spring show in the early morning dew that’s only just melted. I can smell and taste the sweat on my upper lip. And it’s cold.\r\n\r\nAnd then I hear it. \r\n\r\nA few or a thousand steps later. \r\n\r\nThe breathing sound I’ve been listening for.\r\n\r\nThe pace of the rocks quickens, and my head is turned down so the helmet light prevents me from tripping over—or impeding—their journey.\r\n\r\nA famous author once said “All things serve the beam”, and that’s as true in this world as it is in the others. Except this beam—this beacon—is attached to our lost visitor.\r\n\r\nI can only hear the rocks, mumblings, and the breathing sound now. The smell is so musty and thick. Like the air is full of sweat and dust. Like I’ve stuck my head out the window during a heavily falling rain. If I think hard enough about it, soon I’ll be drenched. \r\n\r\nSo, I don’t.\r\n\r\nWhile the rocks are almost the perfect tell, and the Listeners’ too corroborates the evidence, you can never be too sure. Only light can be sure.\r\n\r\nI take a match from the tiny box, snap it to life, and then blow it out. Tiny smoke tendrils curl and waft until they also follow the same flow as the rocks.\r\n\r\nExcellent, we’ve not been led astray.\r\n\r\nA few or a thousand more steps, and the rocks are gathering down an aisle where the breathing is more like wheezing—like the desperate struggle to take in.\r\n\r\nLo and behold, we found them!\r\n\r\nPoor thing, judging by the state of her, she got lost early. She’s likely been here for most of the day. The book covers her face—consuming her head like a kid on a particularly large popsicle. The pages flutter gently against her too-white jaw. \r\n\r\nThe papery quality of her skin, and the wanting muscle mass, show how little time was on our side—not a moment to waste.\r\n\r\nI grab the book by the edges of both back and front covers, it’s got most of her head inside at this point, just her earlobes, hair, and edge of her jaw peak out from beneath the pages I now grip firmly. The wheezing turns into a moan that turns into a sob.\r\n\r\n“Now, now.” I say, and test the hold the book has on its victim. It’s snug, too snug to yank like a leech. I need to treat it like a tick, making sure to get the head out.\r\n\r\nNone of these are intended as puns, but it just happens after being surrounded by books and pros for so long.\r\n\r\nI draw one of the tiny viles strapped in my utility belt and pull the cork out. It smells like nothing to me, but I see the reaction immediately. Our half-consumed explorer moves a bit, her fingers mostly, and I hear a second, tinier moan beneath that of the book’s. I pour a small amount of the substance into the palm of my hand, and I smooth it gently down the spine of the book. It wails again, and so does the girl, both full of sorrow and reluctance. \r\n\r\nI feel the hairs on the back of my neck stand up, so I turn at the hip, cock the flamethrower, and send off a very intentionally long tail of flames. When the feeling subsides, I shrug the weapon back over my shoulder.\r\n\r\nI use the backs of two knuckles to knock gently on the book cover, “It’s time to come back now. My apologies.” I say, and I mean it. The book and the girl moan again, more hollowly, and I can feel the seal—the bond—splitting like a seam. I grip the book again, because these two are stubborn, and have to pry them apart. The color and mass return beneath her skin, and though her eyes are open, they can’t see anything. She’ll be like that for a while, it’s normal. She’ll recover.\r\n\r\nI pour the remaining contents of the bottle down the part of her frazzled blond hair. Tears fill the empty eyes and drip down her face. Her mouth presses into a thin white line and grimaces so intensely that the flesh folds in multiple layers at the corners of her mouth. Great pain.\r\n\r\nEven after a thousand years I still can’t help but feel sorry, so I pull her burning head under my chin, and rub circles into her back. \r\n\r\n“I’m sorry, dear. I know you’ve been told otherwise, but this place is a prison, and that isn’t your story. Yours is still being written, and the one which made you pretty promises is lying and jealous. \r\n\r\n“One day you, if the world is cruel, may yet have a place here. But it’s not today. So let’s go have a cup of tea.” I tell her, as I’ve told many like her. I’ve gotten better at it over the years. I used to have to fight with them. Often I’d give up and just keep them safe until the Head Librarian got back to talk them down. \r\n\r\nShe finally lets out a weak, wheezing breath. I take advantage of the broken seam of her lips and pour a tincture down her throat. I don’t even have to look anymore, I can just feel the specific melodies that make each tincture different. It helps that the one I need usually sings a bit louder as a courtesy, and it’ll purr like a cat when I’ve touched my fingers to it.\r\n\r\nShe chokes a bit, but her eyes start to clear.\r\n\r\nGood enough for now. \r\n\r\nThe back of my neck has another sudden influx of goosebumps. We’ve overstayed our welcome. It’s time to go. \r\n\r\nI put the book back on the shelf. I don’t scold it, just allow its ache and frustration flow through me. I apologize, but there’s no comfort I can give. My words and compassion are meaningless. I’ve noted the volume and will tell the Head Librarian, they might be able to soothe it back to sleep.\r\n\r\nI tap the metal bauble around my neck, and we’re back at my desk.\r\n\r\nI drape the girl onto a nearby loveseat that’s seen better days, starting the kettle before heading to the broom closet to stash the emergency kit.\r\n\r\nShe’ll be fine. People like her (and you) always are.\r\n\r\nThis place was made to help the wanderers and recklessly imaginative. Those who can’t wrap their heads around the world the way it is, and can see the truth of magic between heartbeats and heartbreaks. \r\n\r\nAnd people like me, and the Head Librarian (when they so choose to grace us with their presence), keep the place orderly and open for you… and we’re here to help guide you back on track if you lose inspiration for your own story.\r\n\r\nIt’s the nature of the job—The Library itself. \r\n\r\nWhat else can you expect from a place full of nooks and crannies that people choose to get lost in?', '1693331895OIG (1).jpeg', '2023-08-29', NULL, 409729),
(115, '12', '12 ሲሆን ብዙ ጊዜ ህልም አያለሁ። የማያቸው ህልም ሌላ ቀን (ካየው) ከማያቸው ይለያሉ። የማያቸው ህልሞች የሌሉ እና ሊሆኑ የማይችሉ ነው የሚመስሉት። መንገድ ላይ የሚሄዱ ሰዎች በሙሉ እየሳቁ ነው የሚሄዱት፣ ሲያዩኝ ደሞ እቅፍ ያደርጉኛል ሁሌ የምንፍቃቸው ነው የሚመስሉት፣ ስራቦታ ስገባ ሁሉም ሙዚቃ ከፍተው እየደነሱ ነው ስራ የሚሰሩት አዝነው(ያልሳቁበት) ቀን ያለ አይመስልም፣ አንዲት ልጅ ደሞ ትመጣለች ከየት እንደምት መጣ አላቅም እቅፍ አድርጋ ትጠመጠምብኛለች ምን እንደተፈጠረ ግራ ይገባኛል እጄን ይዛ ትሄዳለች፣ ወደፊት ትሮጣለች፣ እየሳቀች ተመልሳ ትመጣና ዘላ ትጠመጠምብኛለች፣ትስመኛለች፣ አይሰለቻትም መሳም፣ እንደዚ አይነት አሳሳም በአለም ላይ አለ? ብዬ እስክገረም ድረስ... በቃ እነዚን የመሳሰሉ ህልሞች አያለሁ\r\nከእንቅልፌ ስነሳ  ጠረንጴዛ ላይ የሚበራ ሻማ አያለሁ፣ ሚካኤል መሆኑን አቃለው። የቅዠት ቀን እንደሆነ እረዳለሁ፣ ከዛ መንገድ ላይ ስሄድ አንዱ በትከሻው ይገፋኝና \'አንተ እያየህ አትሄድም ደንባራ\' ይለኛል። ከዛ ትራንስፖርት ላይ የሆኑ ሁለት ሰዎች መሀል እገባና ተጣብቄ ስደርስ ቀጭኔ መስዬ እወርዳለው፣ ቢሮ ስደርስ ሊፍቱ አይሰራም በእግሬ 10ኛ ፎቅ ላይ እወጣለሁ፣ ከዛ በአንዴ አስር ሰው ይደውልልኝና የኔን ስራ ካልሰራህ ይለኛል....', NULL, '2023-08-29', NULL, 409729),
(116, 'የሰው ልጅ ጠባይ', 'የሰው ልጅ ጠባይና ባሕርይ እጅጉን ይገርማል።\r\nአንዳንዴ የምንፈልገው ነገር እውነትም የምንፈልገውን ነው? አንዳንዴ የምናሳድደው በእርግጥም መያዝ የምንሻውን ነው? ወይስ ከመያዝ ይልቅ በማሳደድ ውስጥ፣ ከማግኘት ይልቅም በመፈለግ ውስጥ ምሥጢር አለ?\r\n.\r\n.\r\nአንዲትን ሴት አጥብቆ የሚፈልግ ሰው ገጥሞኝ ያውቃል። ሁሌም ቀልቧን ለመማረክ ጥረት ያደርጋል። በአፍላ ትውውቃቸው ወቅት እሷን ካገኘ ከዓለም ምንም እንደማይፈልግ ይነግረኝ ነበር። ያቺ ሴት በዚያ ወቅት ፍጹም ናት። ንጽሕት ናት።  መንፈሱንና ልቡን ሁሉ ሞልታ ነበር። ብዙ ደጅ ጠንቶ የራሱ አደረጋት። የራሱ ከሆነች ቀን ጀምሮ ግን ዋጋዋ ቀንሶ ታየው። ቀድሞ ያልተገለጠ ነጭናጫነቷ የታየው መሰለው። ንጽሕናዋ ፍጽምናዋ ሁሉ ጠፋበት። ውበቷ ሀሰት ሀሰት ሆነበት። “ምን ሆኜ ነበር?” “ምን አስነክታኝ ነበር?” እያለ ለኃጢአቱ ምክንያት ሰጠ። \r\n.\r\n\r\nለውጡ ግን የምንም ሳይሆን የቦታ ለውጥ ነበር። ድሮ ሲያሳድዳት ከፊቱ ነበረች። አኹን ከእጅ መዳፉ ላይ ነች። \r\n.\r\n\r\nአንዳንድ ነገሮች መፈለግ ላይ ብቻ መቆም አለባቸው ? አንዳንድ ነገሮችን አሳድደን ባንይዛቸው ይሻላል? ስኬት የጥረትን ያኽል ጣዕም የለውም? የለውም ወይ?\r\n.\r\n\r\nይህ ሰው ምክንያት ፈልጎ ራቃት። ምክንያት ፈልጋ በተራዋ ፈለገችው። የማግኘት ስካር ሲያፋንነው የእልኋን ተከተለችው። ድሮ የተለመነችው በተራዋ ለመነች። አስለመነች። ምናልባት እሷም የተመኘችው ፈልጎ የማግኘትን ጣዕም መቅመስ፣ ሮጦ የመድረስን ሕልም ማሳካት እንጂ እሱን አልነበረም። ሁለቱም በውስጣቸው ያለውን ዕረፍት አልባ ተቅበዝባዥ ሰይጣን ለማገልገል ታተሩ እንጂ በውስጣቸው ፍቅር የለም —ቅንጣት እንኳ።\r\n.\r\n.\r\nጠቢቡ ሶሎሞን የደረሰበት ይኽ ነው። “ሁሉ ከንቱ የከንቱ ከንቱ” ለማለት ያበቃውን መሰልቸት ለመረዳት ሰሎሞን መኾንን ይጠይቃል። የመድረስ መከራ ኃያል ነውና ሰሎሞን በሎሌው ይቀና እንደኾነ ማን ያውቃል ? የሞላለት ከበርቴ ጌታ ለማኝ መኾን ይሻ እንደሆነ እንዴት ይታሰባል ?\r\n.\r\n.\r\nእንደዚህ በነፍስ ፈልጌያቸው ሳገኛቸው እንደ ጉም የሆኑብኝ … ልኾን ተመኝቻቸው ስሆን ደም እንባ ያስለቀሱኝ … እድሜዬን፣ ገንዘቤን ፣ ጥረቴን ሁሉ ሰጥቻቸው ሲሳካ “ተሳካ የልቤ ሞላ” ከማለት ይልቅ በዓይኔ እንኳ ለማየት ያስጠሉኝ፣ ያንገሸገሹኝ፣ የቀፈፉኝ ብዙ ነገሮች አሉ። ሰዎች እንደ ዕድለኛ በሚቆጥሩኝ ነገር፣ “ታድለህ”በሚሉኝ ነገር፣ እኔን መኾን በተመኙባቸው አንዳንድ ነገሮች እኔ ግን አጥንቴ ድረስ ታምሜ ዐውቃለኹ። ሰው ከእኔ የተመኘውን ነገር እንደ ልብስ አውልቄ ብሰጠው ተመኝቻለኹ። \r\n.\r\n.\r\nየምፈልገውን ነገር እፈልገዋለኹ? መሄድ የምሻበት ሀገር መኖር እፈልጋለኹ ? ሰው የምኞቱ ባርያ የፍላጎቱም ሎሌ ነው። አንዳንዴ እርካታ ፍላጎትን፣ ማግኘትም ጣዕምን ያሳድዳሉ። መድረስ ዋጋውን የማይቀንሰው ደስታ ምንድነው ? ማግኘት የማያደበዝዘው መንገድ ምንድነው? በየቀኑ እንደ ዐዲስ በመገረም ሊሞላኝ የሚችል ነገር ምንድነው? ይህንን ደስታ ለራሴ እመኛለኹ። ይህንን እርካታ ለሰው ሁሉ እመኘዋለኹ። ካልኾነ ግን መንገዴን በእሾኽ ይጠረው፣ በጥርብ ድንጋይም ይዝጋው። አብረውኝ በማይከርሙ ደስታዎች ተሰላችቼያለኹ። \r\n————————', NULL, '2023-08-29', NULL, 409729),
(117, 'Bitsiu', 'Bitsu is good boy and i loves playing games and he like sleeping', NULL, '2023-09-03', NULL, 409729),
(118, 'aaaaaaaaa', 'afoiweujoiwejfa', NULL, '2023-09-17', NULL, 409729);

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `submission_date` date DEFAULT curdate(),
  `submission_time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contactus`
--

INSERT INTO `contactus` (`id`, `email`, `name`, `message`, `submission_date`, `submission_time`) VALUES
(1, 'a@a.a', 'as', 'asssssssssssssssssssssss', '2024-05-07', '11:52:07'),
(2, 'a@a.a', 'as', 'asddasdf', '2024-05-07', '11:53:02'),
(3, 'a@a.a', 'as', 'asdafd', '2024-05-07', '11:53:30'),
(4, 'a@a.a', 'as', 'asddfsdadf', '2024-05-07', '11:54:12'),
(5, 'a@a.a', 'as', 'aaboeiafjsd\r\n', '2024-05-07', '11:54:51'),
(6, 'asdfa', 'ass', 'asdfa\r\n', '2024-05-07', '11:55:13'),
(7, 'asdfa', 'fa', 'asdfasoidfja\r\n', '2024-05-07', '11:55:31'),
(8, 'adfa', 'asdas', 'adfasdf', '2024-05-07', '11:56:30'),
(9, 'asdfaasdf', 'asdfad', 'asdf', '2024-05-07', '11:56:43'),
(10, 'asdfaasdf', ' ', ' \r\nasdf\r\n', '2024-05-07', '11:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `therapist_id` int(10) NOT NULL,
  `his` text NOT NULL,
  `date` date DEFAULT curdate(),
  `time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `user_id`, `therapist_id`, `his`, `date`, `time`) VALUES
(1, 1344336179, 409729, 'varry good\r\n', '2023-10-09', '20:10:25'),
(2, 1344336179, 409729, 'hellow this is you are good', '2023-10-09', '20:10:38'),
(3, 1344336179, 409729, 'number tow', '2023-10-09', '20:10:51'),
(4, 1344336179, 409729, 'In addition, a diagnosis may include information about the severity of the patient\'s condition, as well as any potential complications or risks associated with the condition. It may also include information about the recommended course of treatment or management for the condition.\r\n\r\nOverall, the purpose of a diagnosis is to provide healthcare providers with a clear understanding of the patient\'s condition and the best course of action for treatment and', '2023-10-09', '20:12:00'),
(5, 1344336179, 409729, 'In addition, a diagnosis may include information about the severity of the patient\'s condition, as well as any potential complications or risks associated with the condition. It may also include information about the recommended course of treatment or management for the condition.\r\n\r\nOverall, the purpose of a diagnosis is to provide healthcare providers with a clear understanding of the patient\'s condition and the best course of action for treatment and', '2023-10-09', '20:12:07'),
(6, 1344336179, 409729, 'In addition, a diagnosis may include information about the severity of the patient\'s condition, as well as any potential complications or risks associated with the condition. It may also include information about the recommended course of treatment or management for the condition.\r\n\r\nOverall, the purpose of a diagnosis is to provide healthcare providers with a clear understanding of the patient\'s condition and the best course of action for treatment and', '2023-10-09', '20:15:04'),
(7, 981449511, 409727, 'hi has a displain proble\r\n', '2024-04-07', '15:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `audio` varchar(100) DEFAULT NULL,
  `r_date` date DEFAULT curdate(),
  `r_time` time DEFAULT curtime(),
  `b` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `audio`, `r_date`, `r_time`, `b`) VALUES
(65, 40000, 1344336179, 'P_A', '', '2023-09-09', '23:30:18', ''),
(66, 1344336179, 409727, 'DR_B', '', '2023-09-09', '23:30:18', ''),
(67, 1344336179, 409729, 'DR_Babu', '', '2023-09-09', '23:30:18', ''),
(68, 40000, 1344336179, 'Hi doctors, how are you doing today?', '', '2023-09-09', '23:30:18', ''),
(69, 1344336179, 409727, 'We\'re doing well, thank you. How can we assist you today?', '', '2023-09-09', '23:30:18', ''),
(71, 40000, 1344336179, ' Okay, I understand. Is there anything I can do in the meantime to alleviate my symptoms?', '', '2023-09-09', '23:30:18', ''),
(72, 1344336179, 409729, ' It\'s important that you rest and avoid any strenuous activity until we can determine the underlying cause of your symptoms. We can also prescribe medication to help manage your pain and discomfort.', '', '2023-09-09', '23:30:18', ''),
(73, 40000, 1344336179, ' Thank you, doctors. I appreciate your help and expertise.', '', '2023-09-09', '23:30:18', ''),
(78, 40000, 1288175212, 'hello i am mohammed', '', '2023-09-09', '23:30:18', ''),
(79, 1288175212, 409727, 'hello mohamed', '', '2023-09-09', '23:30:18', ''),
(80, 1288175212, 409729, 'every things allringt?', '', '2023-09-09', '23:30:18', ''),
(81, 40000, 1288175212, 'i am dipressed', '', '2023-09-09', '23:30:18', ''),
(86, 1288175212, 409727, 'So, tell me a little bit about what\'s bringing you in today.', '', '2023-09-10', '18:30:47', ''),
(87, 1288175212, 409729, ' Well, there\'s a lot going on. I\'m starting a new job next week, and I\'m really nervous about it. I\'m also having some problems in my relationship.', '', '2023-09-10', '18:32:23', ''),
(89, 1288175212, 409727, ' It sounds like you\'re facing a lot of challenges right now. It\'s understandable that you\'re feeling anxious.', '', '2023-09-10', '18:33:14', ''),
(90, 40000, 1288175212, ' Yeah, it\'s been tough. I just don\'t know how to handle it all.', '', '2023-09-10', '18:33:35', ''),
(91, 1288175212, 409727, 'Well, that\'s what we\'re here to talk about. I can help you develop some coping mechanisms for dealing with your anxiety. We can also talk about your goals and how we can work together to achieve them', '', '2023-09-10', '18:35:14', ''),
(93, 749791638, 409729, 'hello abebe', '', '2023-09-17', '14:18:33', ''),
(97, 749791638, 409729, 'j', '', '2023-09-20', '20:21:25', ''),
(98, 749791638, 409729, 'adfaf', '', '2023-09-20', '20:21:29', ''),
(102, 409731, 1344336179, 'hi', '', '2023-09-27', '17:01:13', ''),
(103, 409727, 754255729, 'hello doctor', '', '2023-09-27', '17:19:09', ''),
(104, 40000, 754255729, 'hello', '', '2023-09-27', '17:19:23', ''),
(105, 754255729, 409727, 'hi', '', '2023-09-27', '17:20:33', ''),
(106, 754255729, 409727, 'b', '', '2023-09-27', '18:02:21', ''),
(107, 754255729, 409727, 'b', '', '2023-09-27', '18:05:09', ''),
(108, 409727, 754255729, 'b', '', '2023-09-27', '18:13:10', ''),
(109, 754255729, 409727, 'b', '', '2023-09-27', '18:13:30', ''),
(110, 754255729, 409727, 'b', '', '2023-09-27', '18:19:56', '<br /><b>W'),
(111, 754255729, 409727, 'b', '', '2023-09-27', '18:26:48', 'b'),
(112, 409727, 754255729, 'b', '', '2023-09-27', '18:27:20', 'b'),
(113, 40000, 754255729, 'bbb', '', '2023-09-27', '18:27:50', ''),
(114, 517103030, 409727, 'bbb', '', '2023-09-27', '18:28:00', ''),
(115, 409731, 1344336179, 'n', '', '2023-09-27', '20:52:07', 'b'),
(116, 409731, 1344336179, 'hi', '', '2023-09-27', '20:58:29', 'b'),
(117, 1344336179, 409731, 'good', '', '2023-09-27', '21:05:29', ''),
(118, 409727, 754255729, 'hi', '', '2023-09-27', '21:22:41', 'b'),
(119, 754255729, 409727, 'by', '', '2023-09-27', '21:22:51', 'b'),
(120, 754255729, 409727, 'ask', '', '2023-09-27', '21:22:52', 'b'),
(121, 754255729, 409727, 'saoijf', '', '2023-09-27', '21:22:53', 'b'),
(122, 409727, 754255729, 'aisdjkfa', '', '2023-09-27', '21:22:57', 'b'),
(123, 40000, 754255729, 'this is was not be coming', '', '2023-09-27', '21:31:20', ''),
(124, 754255729, 409727, 'ale eko', '', '2023-09-27', '21:39:25', 'b'),
(125, 40000, 754255729, 'ALE EKO EZI MN YSERAL', '', '2023-09-27', '21:41:56', ''),
(126, 125906261, 409727, 'hi b', '', '2023-09-27', '21:45:13', 'b'),
(127, 409727, 125906261, 'hi profile', '', '2023-09-27', '21:45:29', 'b'),
(128, 1344336179, 409727, 'o', '', '2023-09-28', '13:55:53', ''),
(129, 517103030, 409727, 'yes', '', '2023-09-28', '13:57:43', ''),
(130, 1344336179, 409731, 'baba', '', '2023-09-28', '14:00:11', 'b'),
(131, 1344336179, 409731, 'public', '', '2023-09-28', '14:00:42', ''),
(132, 1344336179, 409731, 'private', '', '2023-09-28', '14:01:00', 'b'),
(133, 1344336179, 409731, 'public', '', '2023-09-28', '14:01:59', 'b'),
(134, 1344336179, 409731, 'PUBLIC', '', '2023-09-28', '14:04:54', ''),
(135, 1344336179, 409731, 'PUBLIC', '', '2023-09-28', '14:05:03', ''),
(136, 1344336179, 409731, 'private', '', '2023-09-28', '14:05:12', 'b'),
(137, 1344336179, 409731, 'private', '', '2023-09-28', '14:05:17', 'b'),
(138, 1344336179, 409731, 'ppppppppppppppp', '', '2023-09-28', '14:05:22', 'b'),
(139, 1344336179, 409731, 'pub', '', '2023-09-28', '14:05:33', ''),
(140, 1344336179, 409731, 'pub', '', '2023-09-28', '14:05:36', ''),
(141, 1344336179, 409731, 'priv', '', '2023-09-28', '14:05:44', 'b'),
(142, 40000, 1344336179, 'ab lata public', '', '2023-09-28', '14:17:54', ''),
(143, 1344336179, 409731, 'dr.max to ab lala public', '', '2023-09-28', '14:18:13', ''),
(144, 1344336179, 409727, 'dr. b to ab lala public', '', '2023-09-28', '14:20:49', ''),
(145, 40000, 1344336179, 'thnaks doctory public to speak freely', '', '2023-09-28', '14:21:21', ''),
(146, 1344336179, 409727, 'hello ab baba i am doctor B public', '', '2023-09-28', '14:26:05', ''),
(147, 409731, 1344336179, 'hi', '', '2023-09-28', '23:01:34', 'b'),
(148, 409731, 1344336179, 'hh', '', '2023-09-28', '23:06:52', 'b'),
(149, 409731, 1344336179, 'lewew lij bemulu', '', '2023-09-28', '23:17:58', 'b'),
(150, 1344336179, 409731, 'et', '', '2023-09-28', '23:18:38', 'b'),
(151, 1344336179, 409731, 'public to ablala', '', '2023-09-28', '23:38:27', ''),
(152, 1344336179, 409731, 'private to ab baba', '', '2023-09-28', '23:38:41', 'b'),
(153, 1344336179, 409731, 'privat', '', '2023-09-28', '23:55:13', 'b'),
(154, 1344336179, 409731, 'private', '', '2023-09-28', '23:55:16', 'b'),
(155, 1344336179, 409731, 'private', '', '2023-09-28', '23:55:18', 'b'),
(156, 1344336179, 409731, 'private', '', '2023-09-28', '23:55:22', 'b'),
(157, 1344336179, 409731, 'public', '', '2023-09-28', '23:55:30', ''),
(158, 1344336179, 409731, 'public', '', '2023-09-28', '23:55:33', ''),
(159, 1344336179, 409731, 'public', '', '2023-09-28', '23:55:35', ''),
(160, 40000, 1344336179, 'public', '', '2023-09-28', '23:55:42', ''),
(161, 40000, 1344336179, 'poublic', '', '2023-09-28', '23:55:44', ''),
(162, 409731, 1344336179, 'private', '', '2023-09-28', '23:55:52', 'b'),
(163, 409731, 1344336179, 'private', '', '2023-09-28', '23:55:56', 'b'),
(164, 1344336179, 409729, 'hi', '', '2023-10-09', '18:50:28', ''),
(165, 1344336179, 409729, 'j', '', '2023-10-09', '18:50:38', ''),
(166, 40000, 854067072, 'Hi', '', '2024-02-28', '19:03:24', ''),
(167, 409731, 1344336179, 'hi', '', '2024-03-09', '01:28:57', 'b'),
(168, 409731, 1344336179, 'calling', '', '2024-03-09', '01:29:26', 'b'),
(169, 409731, 1344336179, 'c', '', '2024-03-09', '04:28:14', 'b'),
(170, 409731, 1344336179, 'chat', '', '2024-03-09', '04:33:42', 'b'),
(173, 40000, 1344336179, 'zd', '', '2024-03-14', '09:42:21', ''),
(174, 409731, 1344336179, 'calling', '', '2024-03-18', '20:40:23', 'b'),
(175, 409731, 1344336179, 'calling', '', '2024-03-18', '20:46:05', 'b'),
(176, 409731, 1344336179, 'calling', '', '2024-03-18', '20:46:36', 'b'),
(177, 409731, 1344336179, 'a', '', '2024-03-18', '20:48:13', 'b'),
(178, 409731, 1344336179, 'calling', '', '2024-03-18', '20:48:23', 'b'),
(179, 409731, 1344336179, 'gu', '', '2024-03-27', '02:37:45', 'b'),
(182, 409731, 1344336179, 'hi', '', '2024-03-27', '03:16:49', 'b'),
(183, 409731, 1344336179, 'sssssssss', '', '2024-03-27', '03:16:56', 'b'),
(184, 409731, 1344336179, 'sdffsfd', '', '2024-03-27', '03:17:03', 'b'),
(186, 1344336179, 409731, 'hi', '', '2024-03-27', '03:21:48', 'b'),
(189, 409731, 1344336179, 'hi', '', '2024-03-28', '19:13:01', 'b'),
(199, 409731, 1344336179, 's', '', '2024-03-28', '20:16:31', 'b'),
(201, 409731, 1344336179, 'aaaa', '', '2024-03-28', '20:18:08', 'b'),
(202, 409731, 1344336179, 'ujhj', '', '2024-03-28', '20:18:19', 'b'),
(203, 409731, 1344336179, 'a', '', '2024-03-28', '20:18:59', 'b'),
(204, 409731, 1344336179, 's', '', '2024-03-28', '20:19:42', 'b'),
(205, 409731, 1344336179, 'c', '', '2024-03-28', '20:19:55', 'b'),
(207, 409731, 1344336179, 'yes', '', '2024-03-28', '20:22:59', 'b'),
(208, 409731, 1344336179, 'no', '', '2024-03-28', '20:23:34', 'b'),
(209, 409731, 1344336179, 'this is working', '', '2024-03-28', '20:23:38', 'b'),
(210, 409731, 1344336179, 'you are the best fo  my self', '', '2024-03-28', '20:23:44', 'b'),
(213, 125906261, 409727, 'Hello', '', '2024-03-28', '20:29:56', 'b'),
(214, 125906261, 409727, 'Hi', '', '2024-03-28', '20:30:00', 'b'),
(216, 125906261, 409727, 'Helllo', '', '2024-03-28', '20:38:41', 'b'),
(217, 125906261, 409727, 'Hxdjd', '', '2024-03-28', '20:38:47', 'b'),
(220, 125906261, 409727, 'H', '', '2024-03-28', '20:43:20', 'b'),
(221, 125906261, 409727, 'Hiollllll', '', '2024-03-28', '20:43:27', 'b'),
(222, 409727, 125906261, 'calling', '', '2024-03-28', '21:40:06', 'b'),
(223, 409727, 125906261, 'calling', '', '2024-03-28', '21:40:44', 'b'),
(224, 409727, 1344336179, 'a', '', '2024-03-28', '21:41:50', 'b'),
(225, 409727, 1344336179, 'calling', '', '2024-03-28', '21:42:02', 'b'),
(226, 409727, 1344336179, 'calling', '', '2024-03-28', '21:42:11', 'b'),
(227, 409727, 1344336179, 'calling', '', '2024-03-28', '21:42:12', 'b'),
(228, 409727, 1344336179, 'calling', '', '2024-03-28', '21:42:14', 'b'),
(229, 409727, 1344336179, 'calling', '', '2024-03-28', '21:42:59', 'b'),
(230, 409727, 1344336179, 'calling', '', '2024-03-28', '21:43:09', 'b'),
(232, 409731, 1422175087, 'j', '', '2024-03-31', '10:19:01', 'b'),
(234, 409731, 1422175087, 'h', '', '2024-03-31', '10:28:55', 'b'),
(235, 1422175087, 409731, 'G', '', '2024-03-31', '10:29:00', 'b'),
(239, 409731, 1344336179, 's\\', '', '2024-04-03', '22:58:41', 'b'),
(240, 409731, 1344336179, 's\\', '', '2024-04-03', '22:58:41', 'b'),
(241, 409731, 1344336179, 'eys', '', '2024-04-05', '17:17:04', 'b'),
(242, 409731, 1344336179, 'hello', '', '2024-04-05', '17:18:40', 'b'),
(243, 1344336179, 409731, 'what?', '', '2024-04-05', '17:18:48', 'b'),
(244, 409731, 1344336179, 'it was not working', '', '2024-04-05', '18:12:37', 'b'),
(245, 409731, 1344336179, 'sssssssss', '', '2024-04-05', '18:41:30', 'b'),
(246, 409731, 1344336179, 'kjhj', '', '2024-04-05', '18:46:03', 'b'),
(247, 409731, 1344336179, 'is it working?', '', '2024-04-05', '19:58:40', 'b'),
(249, 409731, 1344336179, 'hi', '', '2024-04-05', '22:07:54', 'b'),
(250, 409731, 1344336179, 'hello', '', '2024-04-05', '22:09:39', 'b'),
(251, 409731, 1344336179, ' you are ok?', '', '2024-04-05', '22:09:48', 'b'),
(252, 409731, 1344336179, 'what about know', '', '2024-04-05', '22:11:40', 'b'),
(253, 409731, 1344336179, 'it was wokring unbliviible', '', '2024-04-05', '22:11:50', 'b'),
(254, 409731, 1422175087, 'hello doc', '', '2024-04-05', '22:16:28', 'b'),
(255, 409731, 1344336179, 'one of the following it saf', '', '2024-04-05', '22:16:49', 'b'),
(265, 1344336179, 409731, 'are youo shore it was working?', '', '2024-04-06', '09:00:56', 'b'),
(269, 1344336179, 409731, 'yes', '', '2024-04-06', '09:06:14', 'b'),
(270, 1344336179, 409731, 'hi', '', '2024-04-06', '09:34:56', 'b'),
(271, 409731, 1344336179, 'what', '', '2024-04-06', '09:35:09', 'b'),
(272, 1344336179, 409731, 'by', '', '2024-04-06', '09:35:13', 'b'),
(273, 409731, 1344336179, 'are you showr', '', '2024-04-06', '09:35:18', 'b'),
(274, 1344336179, 409731, 'this was not good', '', '2024-04-06', '09:35:27', 'b'),
(275, 1344336179, 409731, 'yest', '', '2024-04-06', '09:37:22', 'b'),
(276, 1344336179, 409731, 'outgoing message id  the incoming is 1344336179', '', '2024-04-06', '09:45:26', 'b'),
(277, 1344336179, 409731, 'this was me', '', '2024-04-06', '09:47:15', 'b'),
(278, 409731, 1344336179, 'this was not me', '', '2024-04-06', '09:47:31', 'b'),
(279, 1344336179, 409731, 'this was me', '', '2024-04-06', '09:50:00', 'b'),
(280, 409731, 1344336179, 'i think it was working', '', '2024-04-06', '09:52:20', 'b'),
(281, 1344336179, 409731, 'no it was\'t working', '', '2024-04-06', '09:52:33', 'b'),
(282, 409731, 1344336179, 'yes partially working', '', '2024-04-06', '09:52:52', 'b'),
(283, 409731, 1344336179, 'ih', '', '2024-04-06', '09:55:44', 'b'),
(284, 409731, 1344336179, 'yes', '', '2024-04-06', '09:55:46', 'b'),
(285, 1344336179, 409731, 'no', '', '2024-04-06', '09:55:50', 'b'),
(286, 409731, 1344336179, 'what about know', '', '2024-04-06', '09:59:26', 'b'),
(287, 409731, 1344336179, 'what', '', '2024-04-06', '09:59:30', 'b'),
(288, 409731, 1344336179, 'what happend', '', '2024-04-06', '09:59:38', 'b'),
(289, 409731, 1344336179, 'is the new message', '', '2024-04-06', '10:00:58', 'b'),
(290, 409731, 1344336179, 'what aabout ikasjdf', '', '2024-04-06', '10:01:28', 'b'),
(291, 1344336179, 409731, 'it must be this way', '', '2024-04-06', '10:02:26', 'b'),
(292, 409731, 1344336179, 'a', '', '2024-04-06', '10:02:37', 'b'),
(293, 409731, 1344336179, 'what', '', '2024-04-06', '10:02:42', 'b'),
(294, 409731, 1344336179, 'what a golle', '', '2024-04-06', '10:02:46', 'b'),
(295, 409731, 1344336179, 'aaaaaaaaaaaaaaaaa', '', '2024-04-06', '10:02:59', 'b'),
(296, 409731, 1344336179, 's', '', '2024-04-06', '10:03:06', 'b'),
(297, 409731, 1344336179, 'sssss', '', '2024-04-06', '10:04:10', 'b'),
(298, 409731, 1344336179, 'wwwwwwwwwwwwwwww', '', '2024-04-06', '10:04:42', 'b'),
(299, 409731, 1344336179, 's', '', '2024-04-06', '10:05:53', 'b'),
(300, 409731, 1344336179, 'sds', '', '2024-04-06', '10:07:29', 'b'),
(301, 1344336179, 409731, 'dena nesh?', '', '2024-04-06', '10:07:55', 'b'),
(302, 1344336179, 409731, 'ere tensechea', '', '2024-04-06', '10:07:59', 'b'),
(303, 1344336179, 409731, 'fafa', '', '2024-04-06', '10:08:01', 'b'),
(304, 409731, 1344336179, 'asld;kafjdsdfawera', '', '2024-04-06', '10:08:07', 'b'),
(305, 1344336179, 409731, 'is this working properly?', '', '2024-04-06', '10:46:28', 'b'),
(306, 409731, 1344336179, 'nardio', '', '2024-04-06', '10:46:36', 'b'),
(307, 1344336179, 409731, 'narods', '', '2024-04-06', '10:46:45', 'b'),
(308, 409731, 1344336179, 'ywwwwwwwwwwwwwwwwwww', '', '2024-04-06', '10:46:53', 'b'),
(309, 409731, 1344336179, 's', '', '2024-04-06', '10:46:57', 'b'),
(310, 1344336179, 409731, 'keyet nw yemetachiw ', '', '2024-04-06', '10:47:04', 'b'),
(311, 409731, 1344336179, 'sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', '', '2024-04-06', '10:47:47', 'b'),
(312, 1344336179, 409731, 'alue', '', '2024-04-06', '10:48:04', 'b'),
(313, 1344336179, 409731, 'ay takaktm ante', '', '2024-04-06', '10:48:09', 'b'),
(314, 1344336179, 409731, 'new message', '', '2024-04-06', '11:51:42', 'b'),
(315, 409731, 1344336179, 'hii', '', '2024-04-06', '11:56:24', 'b'),
(316, 409731, 1344336179, 'yes', '', '2024-04-06', '11:56:42', 'b'),
(317, 409731, 1344336179, 'no', '', '2024-04-06', '11:56:48', 'b'),
(318, 409731, 1344336179, 'you are fucketdds', '', '2024-04-06', '11:56:57', 'b'),
(319, 409731, 1344336179, 'lets try', '', '2024-04-06', '12:04:14', 'b'),
(320, 409731, 1344336179, 'what about know', '', '2024-04-06', '12:05:38', 'b'),
(321, 409731, 1344336179, 'it was not wokring', '', '2024-04-06', '12:05:56', 'b'),
(322, 1344336179, 409731, 'wahteowifdsja asodiuta', '', '2024-04-06', '12:06:40', 'b'),
(323, 409731, 1344336179, 'betam yitaftal', '', '2024-04-06', '12:12:09', 'b'),
(324, 1344336179, 409731, 'betam yitaftal', '', '2024-04-06', '12:12:45', 'b'),
(325, 1344336179, 409731, 'is', '', '2024-04-06', '12:17:00', 'b'),
(326, 1344336179, 409731, 'you', '', '2024-04-06', '12:17:04', 'b'),
(327, 409731, 1344336179, 'jyea', '', '2024-04-06', '12:17:38', 'b'),
(328, 409731, 1344336179, 'tebelashe enda', '', '2024-04-06', '12:17:45', 'b'),
(329, 1344336179, 409731, 'mn ymeslhal', '', '2024-04-06', '12:18:11', 'b'),
(330, 409731, 1344336179, 'mamdfa', '', '2024-04-06', '12:18:15', 'b'),
(331, 1344336179, 409731, 'dog', '', '2024-04-06', '12:18:35', 'b'),
(332, 409731, 1344336179, 'hi', '', '2024-04-06', '20:33:28', 'b'),
(333, 409731, 1344336179, 'iw ', '', '2024-04-06', '20:34:58', 'b'),
(334, 409731, 1344336179, 'we', '', '2024-04-06', '20:35:01', 'b'),
(335, 409731, 1344336179, 'you', '', '2024-04-06', '20:35:10', 'b'),
(336, 409731, 1344336179, 'ds', '', '2024-04-06', '20:36:44', 'b'),
(337, 409731, 1344336179, 'this is you', '', '2024-04-06', '20:36:49', 'b'),
(338, 409731, 1344336179, 'yes', '', '2024-04-06', '20:40:55', 'b'),
(339, 409731, 1344336179, 'new', '', '2024-04-06', '20:43:10', 'b'),
(340, 409731, 1344336179, 't', '', '2024-04-06', '20:46:24', 'b'),
(341, 409731, 1344336179, 'a', '', '2024-04-06', '20:47:26', 'b'),
(342, 1344336179, 409731, 'c', '', '2024-04-06', '20:50:00', 'b'),
(343, 1344336179, 409731, 'this was me', '', '2024-04-06', '20:53:04', 'b'),
(344, 1344336179, 409731, 'j', '', '2024-04-06', '20:54:24', 'b'),
(345, 1344336179, 409731, 'h', '', '2024-04-06', '20:54:31', 'b'),
(346, 409731, 1344336179, 'asda', '', '2024-04-06', '21:07:04', 'b'),
(347, 1344336179, 409731, 'hello doctor', '', '2024-04-06', '21:07:48', 'b'),
(348, 409731, 1344336179, 'i am not doctorr you are the doctory ', '', '2024-04-06', '21:08:15', 'b'),
(349, 1344336179, 409731, 'ok patioen i have a disorder in yo you have man y proble as i seen', '', '2024-04-06', '21:08:43', 'b'),
(350, 409731, 1344336179, 'data', '', '2024-04-06', '21:21:46', 'b'),
(351, 409731, 1344336179, 'data', '', '2024-04-06', '21:23:04', 'b'),
(352, 1344336179, 409731, 'da', '', '2024-04-06', '21:23:26', 'b'),
(353, 409731, 1344336179, 'this was you ', '', '2024-04-06', '21:23:48', 'b'),
(354, 1344336179, 409731, 'are you ok?', '', '2024-04-06', '21:23:55', 'b'),
(355, 1344336179, 409731, '1', '', '2024-04-06', '21:28:02', 'b'),
(356, 1344336179, 409731, '12', '', '2024-04-06', '21:28:07', 'b'),
(357, 409731, 1344336179, 'selay', '', '2024-04-06', '21:28:27', 'b'),
(358, 409727, 981449511, 'Hi', '', '2024-04-07', '14:58:37', 'b'),
(360, 409727, 981449511, 'Ghhf', '', '2024-04-07', '14:59:33', 'b'),
(361, 409727, 601169775, 'can ', '', '2024-04-07', '15:00:05', 'b'),
(362, 981449511, 409727, 'hi', '', '2024-04-07', '15:00:18', 'b'),
(363, 409727, 601169775, 'you', '', '2024-04-07', '15:00:18', 'b'),
(364, 601169775, 409727, 'aman', '', '2024-04-07', '15:00:31', 'b'),
(365, 981449511, 409727, 'byb', '', '2024-04-07', '15:00:55', 'b'),
(366, 409727, 981449511, 'Hi', '', '2024-04-07', '15:01:50', 'b'),
(370, 409727, 981449511, 'Hi', '', '2024-04-07', '15:04:45', 'b'),
(372, 601169775, 409727, 'aman endat neh', '', '2024-04-07', '15:05:18', 'b'),
(374, 981449511, 409727, 'what are you doing', '', '2024-04-07', '15:05:28', 'b'),
(375, 409727, 601169775, 'wel come', '', '2024-04-07', '15:05:43', 'b'),
(378, 409731, 1344336179, 'hi', '', '2024-04-07', '16:55:25', 'b'),
(379, 409731, 1344336179, 'yes', '', '2024-04-07', '16:55:28', 'b'),
(380, 409731, 1344336179, 'noo', '', '2024-04-07', '16:55:30', 'b'),
(382, 409731, 1344336179, 'yes this was a very good graphics card youa reaf', '', '2024-04-07', '16:56:00', 'b'),
(383, 409731, 1344336179, 'w', '', '2024-04-07', '16:59:32', 'b'),
(384, 1344336179, 409731, 'yes', '', '2024-04-07', '16:59:57', 'b'),
(385, 1344336179, 409731, 'no', '', '2024-04-07', '17:00:04', 'b'),
(386, 409731, 1344336179, 'you are ok?', '', '2024-04-07', '17:00:09', 'b'),
(388, 1344336179, 409731, 'hi', '', '2024-04-07', '17:03:40', 'b'),
(389, 409731, 1344336179, 'weyane', '', '2024-04-07', '17:04:37', 'b'),
(390, 409731, 1344336179, 'sayfeta', '', '2024-04-07', '17:04:43', 'b'),
(391, 1344336179, 409731, 'amara eyetelekeme', '', '2024-04-07', '17:04:48', 'b'),
(392, 409731, 1344336179, 'hi', '', '2024-04-07', '17:10:01', 'b'),
(393, 1344336179, 409731, 'by', '', '2024-04-07', '17:10:08', 'b'),
(394, 1344336179, 409731, 'by', '', '2024-04-07', '17:10:10', 'b'),
(395, 1344336179, 409731, ' o no', '', '2024-04-07', '17:10:14', 'b'),
(396, 409731, 1344336179, 'what  is no', '', '2024-04-07', '17:10:19', 'b'),
(397, 409731, 1344336179, 'i', '', '2024-04-07', '17:14:56', 'b'),
(398, 409731, 1344336179, 'a', '', '2024-04-07', '17:14:58', 'b'),
(399, 409731, 1344336179, 'g', '', '2024-04-07', '17:14:59', 'b'),
(400, 1344336179, 409731, 's', '', '2024-04-07', '17:15:02', 'b'),
(401, 409731, 1344336179, 's', '', '2024-04-07', '17:18:52', 'b'),
(402, 409731, 1344336179, 's', '', '2024-04-07', '17:18:55', 'b'),
(403, 1344336179, 409731, 'y', '', '2024-04-07', '17:18:57', 'b'),
(404, 1344336179, 409731, 'y', '', '2024-04-07', '17:18:59', 'b'),
(405, 1344336179, 409731, 'y', '', '2024-04-07', '17:18:59', 'b'),
(406, 409731, 1344336179, 'ende ena', '', '2024-04-07', '17:25:19', 'b'),
(407, 409731, 1344336179, 'yemann gofere', '', '2024-04-07', '17:25:27', 'b'),
(408, 1344336179, 409731, '7912341', '', '2024-04-07', '17:25:36', 'b'),
(411, 409731, 1344336179, 'yelegnm you aere genzeb yelegnm', '', '2024-04-07', '18:11:36', 'b'),
(412, 409731, 1344336179, 'enem feraw', '', '2024-04-07', '18:11:40', 'b'),
(413, 409731, 1344336179, 'end telab bet', '', '2024-04-07', '18:11:45', 'b'),
(414, 1344336179, 409731, 'hoso dodi', '', '2024-04-07', '18:12:52', 'b'),
(426, 409731, 1344336179, 'a', '', '2024-04-07', '22:13:33', 'b'),
(431, 409731, 1344336179, 'k', '', '2024-04-07', '22:41:25', 'b'),
(441, 409731, 1344336179, 'seat setugn', '', '2024-04-07', '23:12:57', 'b'),
(442, 1344336179, 409731, 'weedefit lem athedm', '', '2024-04-07', '23:14:16', 'b'),
(445, 409731, 1344336179, 'hi', '', '2024-04-07', '23:19:47', 'b'),
(446, 409731, 1344336179, 'hi', '', '2024-04-07', '23:19:59', 'b'),
(447, 409731, 1344336179, 'by', '', '2024-04-07', '23:20:02', 'b'),
(448, 409731, 1344336179, 'yaoweuwara', '', '2024-04-07', '23:20:05', 'b'),
(449, 409731, 1344336179, 'yes', '', '2024-04-07', '23:20:08', 'b'),
(450, 409727, 125906261, 'w', '', '2024-04-07', '23:21:34', 'b'),
(451, 409727, 125906261, 'are you ok?', '', '2024-04-07', '23:23:27', 'b'),
(452, 409727, 125906261, 'this was a good thing', '', '2024-04-07', '23:23:33', 'b'),
(453, 409727, 125906261, 'you are ok?', '', '2024-04-07', '23:23:38', 'b'),
(456, 409727, 125906261, 'yetarik abatock', '', '2024-04-07', '23:24:40', 'b'),
(457, 409731, 1344336179, 'v', '', '2024-04-08', '06:35:36', 'b'),
(463, 409731, 1344336179, 'text', '', '2024-04-09', '20:09:56', 'b'),
(464, 409731, 1344336179, 'this was sorkg', '', '2024-04-09', '20:10:00', 'b'),
(465, 409731, 1344336179, 'hello', '', '2024-04-09', '20:36:58', 'b'),
(466, 409731, 1344336179, 'yes', '', '2024-04-09', '20:37:18', 'b'),
(482, 409731, 1344336179, 'h', '', '2024-04-10', '09:32:20', 'b'),
(487, 409731, 1344336179, 'a', '', '2024-04-10', '18:07:25', 'b'),
(489, 409731, 1344336179, 'ywegedlen', '', '2024-04-10', '18:07:44', 'b'),
(492, 409731, 1344336179, 'hi ', '', '2024-04-18', '17:41:57', 'b'),
(493, 409731, 1344336179, 'how are you', '', '2024-04-18', '17:42:00', 'b'),
(496, 409731, 1344336179, 'thanks for every thing', '', '2024-04-18', '17:42:48', 'b'),
(497, 409731, 1344336179, 'this was a good thing', '', '2024-04-18', '17:54:20', 'b'),
(498, 409731, 1344336179, 'a', '', '2024-04-18', '17:54:26', 'b'),
(499, 1344336179, 409731, 'you are good person', '', '2024-04-20', '08:20:51', 'b'),
(500, 1288175212, 409731, 'this thing was a grat way', '', '2024-04-20', '16:15:57', ''),
(501, 409731, 1344336179, 'new', '', '2024-04-21', '08:21:02', 'b'),
(502, 409731, 1344336179, 'new', '', '2024-04-21', '08:21:31', 'b'),
(503, 409731, 1344336179, 'this was other new', '', '2024-04-21', '08:22:51', 'b'),
(504, 409731, 1344336179, 'what about know', '', '2024-04-21', '08:25:25', 'b'),
(505, 409731, 1344336179, 'this was newwwwwwwwwwwwww', '', '2024-04-21', '08:27:20', 'b'),
(506, 409731, 1344336179, 'o know', '', '2024-04-21', '08:29:09', 'b'),
(507, 409731, 1344336179, 'o', '', '2024-04-21', '08:29:28', 'b'),
(508, 409731, 1344336179, 'a', '', '2024-04-21', '08:30:20', 'b'),
(509, 409731, 1344336179, 'ccccccccc', '', '2024-04-21', '08:30:23', 'b'),
(510, 409731, 1344336179, 'a', '', '2024-04-21', '08:30:51', 'b'),
(511, 409731, 1344336179, 's', '', '2024-04-21', '08:30:56', 'b'),
(521, 1344336179, 409731, 'a', '', '2024-04-21', '08:47:22', 'b'),
(522, 409731, 1344336179, 'are you ok', '', '2024-04-21', '08:47:34', 'b'),
(523, 1344336179, 409731, 'my name is Dr.Max', '', '2024-04-21', '08:48:14', 'b'),
(524, 409731, 1344336179, 'Are you soure you are writng codrrect?', '', '2024-04-21', '08:48:36', 'b'),
(526, 409731, 1344336179, 'k', '', '2024-04-21', '08:59:37', 'b'),
(528, 409731, 1344336179, 'it was working?', '', '2024-04-21', '09:33:39', 'b'),
(529, 409731, 1344336179, 'no it isn\'t', '', '2024-04-21', '09:33:54', 'b'),
(530, 409731, 1344336179, 'ueustssss', '', '2024-04-21', '09:39:25', 'b'),
(532, 409731, 1344336179, 'new', '', '2024-04-21', '09:40:42', 'b'),
(533, 409731, 1344336179, 'a', '', '2024-04-21', '09:41:16', 'b'),
(534, 1344336179, 409731, 'c', '', '2024-04-21', '09:41:35', 'b'),
(535, 1344336179, 409731, 'c', '', '2024-04-21', '09:42:12', 'b'),
(536, 1344336179, 409731, 'c', '', '2024-04-21', '09:42:41', 'b'),
(537, 409731, 1344336179, 'c', '', '2024-04-21', '09:42:48', 'b'),
(538, 409731, 1344336179, 'a', '', '2024-04-21', '09:43:11', 'b'),
(539, 409731, 1344336179, 'a', '', '2024-04-21', '09:43:21', 'b'),
(540, 409731, 1344336179, 'kk', '', '2024-04-21', '09:44:03', 'b'),
(541, 409731, 1344336179, 'yale ab', '', '2024-04-21', '09:44:37', 'b'),
(542, 1344336179, 409731, 't', '', '2024-04-21', '09:45:24', 'b'),
(543, 1344336179, 409731, 'g', '', '2024-04-21', '09:45:57', 'b'),
(544, 1344336179, 409731, 'q', '', '2024-04-21', '09:46:03', 'b'),
(545, 409731, 1344336179, 'a', '', '2024-04-21', '09:46:56', 'b'),
(546, 409731, 1344336179, 'andeveten yekangehed ', '', '2024-04-21', '09:47:09', 'b'),
(547, 1344336179, 409731, 'really', '', '2024-04-21', '09:47:14', 'b'),
(548, 1344336179, 409731, 'this was kikiking', '', '2024-04-21', '09:47:23', 'b'),
(549, 409731, 1344336179, 'd', '', '2024-04-21', '09:49:24', 'b'),
(550, 409731, 1344336179, 'j', '', '2024-04-21', '09:51:59', 'b'),
(551, 409731, 1344336179, 'h', '', '2024-04-21', '09:53:24', 'b'),
(552, 409731, 1344336179, 'j', '', '2024-04-21', '09:54:44', 'b'),
(553, 1344336179, 409731, 'h', '', '2024-04-21', '09:55:00', 'b'),
(554, 409731, 1344336179, 'k', '', '2024-04-21', '10:03:36', 'b'),
(555, 1344336179, 409731, 'my phone is  doctor phpot and ', '', '2024-04-21', '10:04:16', 'b'),
(556, 409731, 1344336179, 's', '', '2024-04-21', '10:05:23', 'b'),
(557, 409731, 1344336179, 'formsumation', '', '2024-04-21', '10:06:05', 'b'),
(558, 409731, 1344336179, 'a', '', '2024-04-21', '10:06:55', 'b'),
(559, 1344336179, 409731, 'a', '', '2024-04-21', '10:07:33', 'b'),
(560, 409731, 1344336179, 'i', '', '2024-04-21', '10:07:42', 'b'),
(561, 409731, 1344336179, 'jo', '', '2024-04-21', '10:07:52', 'b'),
(562, 1344336179, 409731, 'whay bezi bekul', '', '2024-04-21', '10:08:04', 'b'),
(563, 409731, 1344336179, 'j', '', '2024-04-21', '10:12:53', 'b'),
(564, 1344336179, 409731, 'j', '', '2024-04-21', '10:13:04', 'b'),
(565, 409731, 1344336179, 'r', '', '2024-04-21', '10:16:16', 'b'),
(566, 409731, 1344336179, 'a', '', '2024-04-21', '10:16:25', 'b'),
(567, 409731, 1344336179, 'r', '', '2024-04-21', '10:16:43', 'b'),
(568, 409731, 1344336179, 'r', '', '2024-04-21', '10:16:58', 'b'),
(569, 1344336179, 409731, 's', '', '2024-04-21', '10:17:05', 'b'),
(570, 409731, 1344336179, 'a', '', '2024-04-21', '10:19:15', 'b'),
(571, 1344336179, 409731, 'a', '', '2024-04-21', '10:19:20', 'b'),
(572, 1344336179, 409731, 'c', '', '2024-04-21', '10:19:25', 'b'),
(573, 409731, 1344336179, 's', '', '2024-04-21', '10:20:00', 'b'),
(574, 409731, 1344336179, 's', '', '2024-04-21', '10:20:22', 'b'),
(575, 409731, 1344336179, 's\\', '', '2024-04-21', '10:22:39', 'b'),
(576, 1344336179, 409731, 'plaise', '', '2024-04-21', '10:22:46', 'b'),
(577, 409731, 1344336179, 'one', '', '2024-04-21', '10:25:06', 'b'),
(578, 1344336179, 409731, 'two', '', '2024-04-21', '10:25:11', 'b'),
(579, 409727, 125906261, 'a', '', '2024-04-21', '10:25:47', 'b'),
(580, 125906261, 409727, 'wellcom', '', '2024-04-21', '10:26:23', 'b'),
(581, 409727, 125906261, 'whay', '', '2024-04-21', '10:26:32', 'b'),
(582, 125906261, 409727, 'yes', '', '2024-04-21', '10:27:09', 'b'),
(583, 125906261, 409727, 'no', '', '2024-04-21', '10:27:18', 'b'),
(584, 125906261, 409727, 'w', '', '2024-04-21', '10:29:04', 'b'),
(585, 125906261, 409727, 's', '', '2024-04-21', '10:29:17', 'b'),
(586, 125906261, 409727, 's', '', '2024-04-21', '10:29:56', 'b'),
(587, 125906261, 409727, 's', '', '2024-04-21', '10:30:17', 'b'),
(588, 125906261, 409727, 'f', '', '2024-04-21', '10:31:56', 'b'),
(589, 125906261, 409727, 's', '', '2024-04-21', '10:32:08', 'b'),
(590, 409727, 125906261, 'y', '', '2024-04-21', '10:32:31', 'b'),
(591, 409727, 125906261, 'i think this was working', '', '2024-04-21', '10:32:39', 'b'),
(594, 409731, 1344336179, 'hi doc', '', '2024-04-21', '10:35:35', 'b'),
(595, 1344336179, 409731, 'it ws god thing', '', '2024-04-21', '10:35:42', 'b'),
(596, 1344336179, 409731, 'whay', '', '2024-04-21', '10:35:51', 'b'),
(597, 1344336179, 409731, 'this was funy', '', '2024-04-21', '10:38:50', 'b'),
(598, 1344336179, 409731, 'tegebi hidet', '', '2024-04-21', '10:40:39', 'b'),
(599, 409731, 1344336179, 'hi', '', '2024-04-21', '10:42:59', 'b'),
(600, 409727, 125906261, 'they are not geeting hit smessage', '', '2024-04-21', '10:43:10', 'b'),
(601, 125906261, 409727, 'you are a good doctor', '', '2024-04-21', '10:43:18', 'b'),
(604, 409731, 1344336179, 'i', '', '2024-04-21', '10:44:17', 'b'),
(609, 409731, 1344336179, 'you are a good person', '', '2024-04-21', '11:19:26', 'b'),
(610, 409731, 1344336179, 'this was working correctly?', '', '2024-04-21', '11:20:47', 'b'),
(611, 409731, 1344336179, 'it think it is', '', '2024-04-21', '11:20:53', 'b'),
(612, 409731, 1344336179, 'yes', '', '2024-04-21', '16:36:29', 'b'),
(613, 409731, 1344336179, 'first of all', '', '2024-04-21', '16:59:16', 'b'),
(614, 409731, 1344336179, 'what happens', '', '2024-04-21', '16:59:27', 'b'),
(615, 1344336179, 409731, 'good morning doctor', '', '2024-04-21', '17:00:20', 'b'),
(616, 1344336179, 409731, 's', '', '2024-04-21', '17:02:28', 'b'),
(617, 1344336179, 409731, 'f', '', '2024-04-21', '17:03:00', 'b'),
(618, 409731, 1344336179, 'ssssssssssss', '', '2024-04-21', '17:04:00', 'b'),
(619, 409731, 1344336179, 'a', '', '2024-04-21', '17:04:36', 'b'),
(620, 409731, 1344336179, 'aaaaaaaaaaaaaaaa', '', '2024-04-21', '17:04:39', 'b'),
(621, 409731, 1344336179, 'asdaaaaaaaaadd', '', '2024-04-21', '17:04:45', 'b'),
(622, 409731, 1344336179, 'iujk', '', '2024-04-21', '17:31:25', 'b'),
(623, 409731, 1344336179, 'iuhk', '', '2024-04-21', '17:49:35', 'b'),
(624, 409731, 1344336179, 'sasd', '', '2024-04-21', '17:55:59', 'b'),
(625, 409731, 1344336179, 'asdlfja', '', '2024-04-21', '17:56:04', 'b'),
(626, 1344336179, 409731, 'it was goo if you are working', '', '2024-04-21', '17:56:31', 'b'),
(627, 1344336179, 409731, 'i', '', '2024-04-21', '18:40:13', 'b'),
(628, 1344336179, 409731, 'You are good', '', '2024-04-22', '19:56:11', 'b'),
(629, 409731, 1344336179, 's', '', '2024-04-23', '03:54:13', 'b'),
(630, 40000, 1288175212, 'hello doc', '', '2024-04-23', '18:14:47', ''),
(631, 409729, 1288175212, 'are yo ushoure', '', '2024-04-23', '18:16:45', 'b'),
(638, 409727, 125906261, 'you are the good', '', '2024-04-23', '21:52:57', 'b'),
(641, 40000, 1344336179, 'hello doctor', '', '2024-04-24', '20:12:57', ''),
(642, 409731, 1344336179, 'hi', '', '2024-04-25', '18:50:00', 'b'),
(643, 1344336179, 409731, 'by', '', '2024-04-25', '18:50:06', 'b'),
(644, 409731, 1344336179, 'yare ', '', '2024-04-28', '10:39:53', 'b'),
(645, 1344336179, 409731, 'a', '', '2024-04-28', '10:39:56', 'b'),
(646, 409731, 1344336179, 'ahdaf', '', '2024-04-28', '21:52:02', 'b'),
(647, 409731, 1344336179, '', 'audio_1714330332627.mp3', '2024-04-28', '21:52:12', 'b'),
(648, 40000, 1344336179, 'hu', '', '2024-05-01', '08:31:55', ''),
(649, 40000, 1344336179, 'hi', '', '2024-05-01', '08:55:05', ''),
(650, 40000, 1344336179, 'good moring doctor', '', '2024-05-01', '08:55:12', ''),
(651, 40000, 125906261, 'it must have message', '', '2024-05-01', '08:57:57', ''),
(652, 409729, 125906261, 'what?', '', '2024-05-01', '08:58:03', 'b'),
(653, 40000, 125906261, 'a', '', '2024-05-01', '09:04:30', ''),
(654, 125906261, 40000, 'kkkkkkkkkkk', '', '2024-05-01', '09:14:01', ''),
(655, 40000, 125906261, 'hi', '', '2024-05-01', '09:25:25', ''),
(656, 409729, 1344336179, 'hello doc', '', '2024-05-01', '18:26:26', 'b'),
(657, 1344336179, 409729, 'a', '', '2024-05-01', '20:28:02', 'b'),
(658, 1344336179, 409729, 'a', '', '2024-05-01', '20:28:37', 'b'),
(659, 409729, 1344336179, 'lasx', '', '2024-05-01', '20:28:57', 'b'),
(660, 1344336179, 40000, 'are u ok?', '', '2024-05-02', '18:10:43', ''),
(661, 1344336179, 40000, 'are u ok?', '', '2024-05-02', '18:10:43', ''),
(662, 1344336179, 40000, 'are you ok', '', '2024-05-02', '18:10:51', ''),
(663, 40000, 414959494, 'hello doc', '', '2024-05-02', '18:19:38', ''),
(664, 414959494, 40000, 'hi', '', '2024-05-02', '18:20:54', ''),
(665, 414959494, 40000, 'you', '', '2024-05-02', '18:35:04', ''),
(666, 40000, 1145988528, 'hello docktory', '', '2024-05-02', '18:40:05', ''),
(667, 40000, 1344336179, 'hello doctory', '', '2024-05-02', '18:51:11', ''),
(668, 40000, 414959494, 'this was not workofkasfd', '', '2024-05-02', '18:51:30', ''),
(669, 125906261, 40000, 'please doc', '', '2024-05-02', '18:52:25', ''),
(670, 40000, 125906261, 'what a please', '', '2024-05-02', '18:52:43', ''),
(671, 40000, 414959494, 'i have to come first', '', '2024-05-02', '18:52:52', ''),
(672, 40000, 1344336179, 'why?', '', '2024-05-02', '18:52:56', ''),
(673, 40000, 1344336179, 'endat endat nw?', '', '2024-05-02', '18:53:18', ''),
(674, 40000, 125906261, 'b', '', '2024-05-02', '18:53:38', ''),
(675, 1344336179, 40000, 'let me send to oyou', '', '2024-05-02', '18:53:47', ''),
(676, 776006389, 40000, 'you must talk to me', '', '2024-05-02', '18:55:00', ''),
(677, 1145988528, 40000, 'what about you', '', '2024-05-02', '18:55:42', ''),
(678, 1145988528, 40000, 'hello', '', '2024-05-02', '18:59:02', ''),
(679, 1145988528, 40000, 'oooooooooooooooooooooo', '', '2024-05-02', '18:59:06', ''),
(680, 1145988528, 40000, '', 'audio_1714665577595.mp3', '2024-05-02', '18:59:37', ''),
(681, 40000, 1344336179, '1', '', '2024-05-02', '19:00:14', ''),
(682, 40000, 1344336179, 'i think this was good', '', '2024-05-02', '19:04:05', ''),
(683, 40000, 414959494, 'what bout me?', '', '2024-05-02', '19:04:16', ''),
(684, 1145988528, 40000, 'good ', '', '2024-05-02', '19:04:49', ''),
(685, 409731, 414959494, 'H', '', '2024-05-02', '21:59:12', 'b'),
(686, 414959494, 409731, 'hello', '', '2024-05-02', '22:01:02', 'b'),
(687, 409731, 414959494, 'hi', '', '2024-05-03', '00:35:25', 'b'),
(688, 409729, 125906261, 'hello', '', '2024-05-03', '00:35:49', 'b'),
(689, 125906261, 409729, 'this was good', '', '2024-05-03', '00:35:54', 'b'),
(690, 409731, 414959494, 'k', '', '2024-05-03', '00:48:06', 'b'),
(691, 414959494, 409731, 'k', '', '2024-05-03', '00:48:24', 'b'),
(692, 40000, 829981669, 'hi', '', '2024-05-04', '14:58:56', ''),
(693, 40000, 829981669, 'bt', '', '2024-05-04', '14:59:23', ''),
(694, 829981669, 40000, 'by', '', '2024-05-04', '15:00:36', ''),
(695, 829981669, 40000, '', 'audio_1714824051443.mp3', '2024-05-04', '15:00:51', ''),
(696, 40000, 829981669, '', 'audio_1714824063106.mp3', '2024-05-04', '15:01:03', ''),
(697, 829981669, 409731, 'hi', '', '2024-05-05', '17:29:35', 'b'),
(698, 829981669, 40000, 'are you ok?', '', '2024-05-06', '08:40:33', ''),
(699, 409729, 1344336179, 'j', '', '2024-05-06', '14:15:57', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `therapist`
--

CREATE TABLE `therapist` (
  `unique_id` int(11) NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `specialization` text DEFAULT NULL,
  `img` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `r_date` date DEFAULT curdate(),
  `r_time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `therapist`
--

INSERT INTO `therapist` (`unique_id`, `fname`, `lname`, `email`, `password`, `specialization`, `img`, `phone`, `status`, `r_date`, `r_time`) VALUES
(40000, 'Speak', 'Freely', 's', 's', NULL, 'icon-doctor.png', NULL, 'Active now', '2023-09-09', '23:30:18'),
(409727, 'Dr. B', 'Dc', 'b@gmail.com', 'b', 'Music therapy', 'd.jpg', '9841321', 'Active now', '2023-09-09', '23:30:18'),
(409729, 'Dr. Babu', 'Mamu', 'ba@gmail.com', 'b', 'physycology', 'R.jpeg', '2071231092', 'Active now', '2023-09-09', '23:30:18'),
(409731, 'Dr. Max', 'Pro', 'max@m.com', 'm', 'therapistt', 'max.jpg', NULL, 'Offline now', '2023-09-09', '23:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `relationship` varchar(100) DEFAULT NULL,
  `r_date` date DEFAULT curdate(),
  `r_time` time DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `gender`, `birthdate`, `relationship`, `r_date`, `r_time`) VALUES
(2, 1344336179, 'Ab', 'La', 'a@a.a', 'a', '1691844620_491757a7-2c34-4149-9c2d-8330de16086c.jpg', 'Offline now', 'Male', '2000-01-02', 'single', '2023-09-09', '23:30:18'),
(3, 125906261, 'b', 'b', 'b@b.b', 'b', '1691844684_a808bc90-b584-44a0-8f25-0c71c41b8904.jpg', 'Offline now', 'Male', '2000-01-02', 'single', '2023-09-09', '23:30:18'),
(4, 414959494, 'Brhanemeskel', 'Seyfu', 's@s.s', 's', '1691934067OIG.on38U.jpeg', 'Active now', 'Male', NULL, NULL, '2023-09-09', '23:30:18'),
(5, 948529803, 'Kurabachew', 'Mengiste', 'k@k.k', 'a', '1691934700_de1480c3-bd73-4dbc-b69d-924f27c32de8.jpg', 'Offline now', 'Male', NULL, NULL, '2023-09-09', '23:30:18'),
(6, 1288175212, 'Mohammed', 'Tofik', 'm@m.m', 'm', '1691934798_435de52f-9af7-46ae-8a69-06a1273af7ad.jpg', 'Offline now', 'Male', NULL, NULL, '2023-09-09', '23:30:18'),
(7, 429458287, 'bitsu', 'berhaneselassie', 'mpro@gmail.com', 'abco', '1692100382wide-angle-shot-single-tree-growing-clouded-sky-during-sunset-surrounded-by-grass.jpg', 'Offline now', NULL, NULL, NULL, '2023-09-09', '23:30:18'),
(8, 1079166232, 'aa', 'w', 'sdf@aga.as', 'dksf', '16935579445lvdjvra.png', 'Offline now', NULL, NULL, NULL, '2023-09-09', '23:30:18'),
(9, 978949899, 'asdfj', 'sdfaasdf', 'asdf@skfjn.s', 'afdjk', '1693557976OIG..jpeg', 'Offline now', NULL, NULL, NULL, '2023-09-09', '23:30:18'),
(10, 137879262, 'yaou', 'aaf', 'k@al.c', 'k', '1693558081unsolicited-advices.png', 'Offline now', NULL, NULL, NULL, '2023-09-09', '23:30:18'),
(11, 1147266174, 'afdalsk', 'alksdf', 's@al.c', 'ALSDF', '1693558310OIG (1).jpeg', 'Offline now', NULL, NULL, NULL, '2023-09-09', '23:30:18'),
(12, 220582932, 'aosdf', 'faljk', 'a@al.s', 'a', '1693558493Screenshot 2023-08-28 194751.png', 'Offline now', NULL, NULL, NULL, '2023-09-09', '23:30:18'),
(13, 517103030, 'belete', 'kebede', 'b@l.com', 'b', '1694101989committing-to-someone.png', 'Offline now', 'male', '1997-01-31', 'single', '2023-09-09', '23:30:18'),
(14, 1145988528, 'a', 'a', 'a@s.com', 'a', '1694102235OIG (1).jpeg', 'Offline now', 'male', '2023-09-14', 'engaged', '2023-09-09', '23:30:18'),
(15, 749791638, 'abebe', 'kebede', 'ab@gmail.com', 'ab', '1694949129OIP.jpeg', 'Offline now', 'Male', '1990-09-18', 'Single', '2023-09-17', '14:12:09'),
(16, 754255729, 's', 's', 'ss@s.s', 's', '1695824018unity-and-love-partnership-as-ropes-shaped-as-a-heart-in-a-group-of-diverse-strings-connected-together-shaped-as-a-support-symbol-expressing-2BHFYP6.jpg', 'Offline now', 'Female', '2015-02-27', 'Single', '2023-09-27', '17:13:38'),
(18, 776006389, 'first', 'name', 'f@f.f', 'f', '1710273723location.jpg', 'offline now', 'Female', '2006-05-08', 'Engaged', '2024-03-12', '23:02:03'),
(20, 981449511, 'K', 'M', 'Km@gmail.com', 'km', '171249100720240407_120636.jpg', 'Offline now', 'Male', '2024-04-01', 'Single', '2024-04-07', '14:56:47'),
(21, 601169775, 'Amensisa', 'Kumi', 'amensisakm@gmail.com', 'amensisakm', '171249108171a7bfbc5317a4cf82f62916ac4de4a7.jpg', 'offline now', 'Male', '1990-06-05', 'Single', '2024-04-07', '14:58:01'),
(22, 829981669, 'abebe', 'kebede', 'abebe@gmail.com', 'a', '1714823906OIP.jpeg', 'Offline now', 'Male', '2000-09-18', 'Engaged', '2024-05-04', '14:58:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `therapist_id` (`therapist_id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poster_id` (`poster_id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `therapist_id` (`therapist_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `therapist`
--
ALTER TABLE `therapist`
  ADD PRIMARY KEY (`unique_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=700;

--
-- AUTO_INCREMENT for table `therapist`
--
ALTER TABLE `therapist`
  MODIFY `unique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=409732;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`unique_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`therapist_id`) REFERENCES `therapist` (`unique_id`);

--
-- Constraints for table `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`poster_id`) REFERENCES `therapist` (`unique_id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`unique_id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`therapist_id`) REFERENCES `therapist` (`unique_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
