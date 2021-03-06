<?php
require("../../inc/header.php");

/*
		SoftName : EmpireBak Version 2010
		Author   : wm_chief
		Copyright: Powered by www.phome.net
*/

DoSetDbChar('utf8');
E_D("DROP TABLE IF EXISTS `information`;");
E_C("CREATE TABLE `information` (
  `id` int(11) NOT NULL,
  `introduced` text COMMENT '公司简介',
  `rules` text COMMENT '奖金制度',
  `company` text COMMENT '公司账户',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8");
E_D("replace into `information` values('1','                     <p><strong><span style=\"BACKGROUND-COLOR: #3366ff\"><span style=\"color:#3333ff;BACKGROUND-COLOR: #ffffcc\">&nbsp;</span></span></strong></p><p><strong><span style=\"font-size:13.5pt;font-family:Arial;\">who we are[</span><span style=\"font-size:13.5pt;font-family:黑体;\">我们是谁</span><span style=\"font-size:13.5pt;font-family:Arial;\">]</span></strong></p><p><span style=\"font-size:9pt;font-family:Arial;\">we are truly international team.[</span><span style=\"font-size:9pt;font-family:宋体;\">我们是真正的国际团队</span><span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p><span style=\"font-size:9pt;font-family:Arial;\">experts. innovators. entrepreneurs. thought leaders. [</span><span style=\"font-size:9pt;font-family:宋体;\">专家</span><span style=\"font-size:9pt;font-family:Arial;\">.</span><span style=\"font-size:9pt;font-family:宋体;\">创业家</span><span style=\"font-size:9pt;font-family:Arial;\">.</span><span style=\"font-size:9pt;font-family:宋体;\">企业家</span><span style=\"font-size:9pt;font-family:Arial;\">.</span><span style=\"font-size:9pt;font-family:宋体;\">思想领袖</span><span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p><strong><span style=\"font-size:13.5pt;font-family:Arial;\">we are skilled</span><span style=\"font-size:13.5pt;font-family:黑体;\">[</span><span style=\"font-size:13.5pt;font-family:黑体;\">我们非常熟练]</span></strong></p><p><span style=\"font-size:9pt;font-family:Arial;\">Product Development. Manufacturing. Engineering. Software Development. Mobile. Marketing.Distribution.[</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">产品开发</span><span style=\"font-family:Arial;color:rgb(51, 51, 51);\">.</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">制造</span><span style=\"font-family:Arial;color:rgb(51, 51, 51);\">.</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">工程</span><span style=\"font-family:Arial;color:rgb(51, 51, 51);\">.</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">软件开发</span><span style=\"font-family:Arial;color:rgb(51, 51, 51);\">.</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">移动</span><span style=\"font-family:Arial;color:rgb(51, 51, 51);\">.</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">营销</span><span style=\"font-family:Arial;color:rgb(51, 51, 51);\">.</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">发布</span><span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p><span style=\"font-size:9pt;font-family:Arial;\">&nbsp;</span></p><p><strong><span style=\"font-size:13.5pt;font-family:Arial;\">We have worked around the world.</span><span style=\"font-size:13.5pt;font-family:黑体;\"> [</span><span style=\"font-size:13.5pt;font-family:黑体;\">我们遍布世界各地]</span></strong></p><p><span style=\"font-size:9pt;font-family:Arial;\">USA</span><span style=\"font-size:9pt;font-family:Arial;\">, Singapore, Spain,China, Taiwan, the Philippines.[</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">美国</span>，新加坡，西班牙，中国，台湾，菲律宾。<span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p><img src=\"http://www.uskreyos.com/kindeditor-4.1.9/attached/image/20131111/20131111045840_33181.jpg\" alt=\"\" data-pinit=\"registered\" /><br /></p><p><span style=\"font-size:9pt;font-family:Arial;\">&nbsp;</span><strong><span style=\"font-size:13.5pt;font-family:Arial;\">We have worked for world-class companies.</span><span style=\"font-size:13.5pt;font-family:黑体;\"> [</span><span style=\"font-size:13.5pt;font-family:黑体;\">我们来自世界级企业]</span></strong></p><p><img src=\"http://www.uskreyos.com/kindeditor-4.1.9/attached/image/20131111/20131111045825_30091.jpg\" alt=\"\" data-pinit=\"registered\" /><br /></p><p><strong><span style=\"font-size:13.5pt;font-family:Arial;\">We each have our special passions.[</span><span style=\"font-size:13.5pt;font-family:黑体;\">我</span>们每个人都有自己特殊的激情]</strong></p><p><span style=\"font-size:9pt;font-family:Arial;\">Our work. Our families. Our countries. Our pets. Our sports.[</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">我们的工作。</span>我们的家庭。我们的国家。<span style=\"font-family:宋体;\">我们的宠物。<span style=\"color:rgb(51, 51, 51);\">我国体育</span>。</span><span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p><span style=\"font-size:9pt;font-family:Arial;\"><img src=\"http://www.uskreyos.com/xheditor/xheditor_skin/blank.gif\" class=\"wordImage\" width=\"48\" height=\"27\" alt=\"\" /></span></p><p><strong><span style=\"font-size:13.5pt;font-family:Arial;\">And we love sports and physical fitness.[</span><span style=\"font-size:13.5pt;font-family:黑体;\">而且我们喜欢</span>体育和健身<span style=\"font-size:13.5pt;font-family:Arial;\">]</span></strong></p><p><span style=\"font-size:9pt;font-family:Arial;\">Swimming. Golf. Walking. Running. Cycling. Basketball. Tennis. Soccer.Even horseback riding.[</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">游泳。</span>高尔夫球。步行。运行。骑自行车。篮球。网球。足球。甚至是骑马。<span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p><span style=\"font-size:9pt;font-family:Arial;\">&nbsp;</span></p><p><span style=\"font-size:9pt;font-family:Arial;\">We may be a small team. But each and every one of us feels invested in theKreyos Meteor smartwatch. We have worked hard and put ourselves into itsdevelopment. We want to see it succeed. We want to use it. So we made sure thatwhen we built the Meteor, we built a smartwatch that had everything in it thatwe wanted, and more! We hope you enjoy wearing and using it. As much as weenjoyed making it</span></p><p><span style=\"font-size:9pt;font-family:Arial;\">[</span><span style=\"font-family:宋体;color:rgb(51, 51, 51);\">我们可能是一个小团队。</span>但我们每一个人都全部投资在克雷尔斯智能手表。我们工作得很努力，把自己纳入其发展。我们希望看到它成功。我们要用它。所以我们相信，当我们建立克雷尔斯，我们建立了一个智能手表，都是我们想要的，更重要的是！我们希望你喜欢佩戴和使用它。就像我们喜欢它<span style=\"font-size:9pt;font-family:Arial;\">]</span></p><p></p>					','                             &nbsp;&nbsp;<p><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"499\"><tbody><tr><td style=\"WIDTH: 73.5pt; HEIGHT: 28.5pt\"><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">Amount</span></span></p><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">金额</span></span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 28.5pt\"><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">Game Coins</span></span></p><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">游戏币比例</span></span></p></td><td style=\"WIDTH: 66.75pt; HEIGHT: 28.5pt\"><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">Reward</span></span></p><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">奖金比例</span></span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 28.5pt\"><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">Incomeof Game</span></span></p><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">游戏币收益</span></span></p></td><td style=\"WIDTH: 73.5pt; HEIGHT: 28.5pt\"><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">Spending</span></span></p><p><span style=\"font-size:16px;\"><span style=\"font-family:宋体;\">消费币</span></span></p></td></tr><tr><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$500</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">45%</span></p></td><td style=\"WIDTH: 66.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">55%</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$5,000</span></p></td><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$1,000</span></p></td></tr><tr><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$1,000</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">50%</span></p></td><td style=\"WIDTH: 66.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">50%</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$10,000</span></p></td><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$2,000</span></p></td></tr><tr><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$2,000</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">55%</span></p></td><td style=\"WIDTH: 66.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">45%</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$20,000</span></p></td><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$4,000</span></p></td></tr><tr><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$3,000</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">60%</span></p></td><td style=\"WIDTH: 66.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">40%</span></p></td><td style=\"WIDTH: 81.75pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$30,000</span></p></td><td style=\"WIDTH: 73.5pt; HEIGHT: 18.75pt\"><p><span style=\"font-family:Times New Roman;font-size:16px;\">US\$6,000</span></p></td></tr></tbody></table></p><p>&nbsp;三进三出,每个帐号最高收益封顶投资额的10倍,达到10倍自动兑现,并停止交易,但保留推荐权利;</p><p>&nbsp;达到10倍后扣留20%作为消费币用于购买公司产品。</p><p>1.<span style=\"font-family:宋体;\">推荐奖</span>:10% </p><div><div>2.<span style=\"font-family:宋体;\">对碰奖</span>:8% (1:1) &nbsp; &nbsp; &nbsp; 日封顶为投资额的2倍.</div><div>3.<span style=\"font-family: 宋体;\">见点</span>: <span style=\"font-family:宋体;\">一层</span>5% </div><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-family:宋体;\">二层</span>4% </div><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-family:宋体;\">三层</span>3% </div><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-family:宋体;\">四层</span>2% </div><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style=\"font-family:宋体;\">五层</span>1% </div></div><p>提现周期为一周(建议用奖金报单省10%提现手续费).</p><p>&nbsp;</p>							','    <p>See the recommand</p><p>详细询问推荐人的兑换美元账户</p>	');");

require("../../inc/footer.php");
?>