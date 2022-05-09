USE owasp;
CREATE TABLE `users` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(100) NOT NULL,
    `last_name` varchar(100) NOT NULL,
    `username` varchar(255) NOT NULL,
    `password` varchar(255) NOT NULL,
    PRIMARY KEY `id` (`id`),
    UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `posts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `text` TEXT NOT NULL,
    `user_id` INT(11) NOT NULL,
    PRIMARY KEY `id` (`id`),
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `users` VALUES (1,'Blaze','Prohaska','jwunsch','cd54c46f688daef7d06a9a5d97161c8a008c6883'),
                           (2,'Stacy','Swift','melisa.willms','c550631abff8b274a075c8e0b4975e80b721e491'),
                           (3,'Louie','Hessel','dmaggio','6761e731dab5567a23f7bbf647deae2663a2161e'),
                           (4,'Wava','Schumm','raquel50','4fd80d913f8aa076aea9515b4b286f4579042c48'),
                           (5,'Filomena','DuBuque','mabernathy','5a411f39ed0383a11a6c4eaedf2449fda122e972');

INSERT INTO `posts` VALUES (1,'magnam','Sunt id voluptate sint velit numquam quae. Molestiae deleniti ut maxime labore debitis hic. Qui dolores maiores suscipit qui natus nesciunt eum. Rerum nobis impedit vel in sunt facilis.',1),
                           (2,'voluptate','Eligendi soluta eum nisi quam ipsum velit. Corporis suscipit eum occaecati corrupti ipsa consequatur. Error sunt animi aliquid est dolores sunt. Facere consequatur ipsa possimus facilis.',2),
                           (3,'aut','Non voluptates excepturi perferendis illo qui est. Perspiciatis odit corporis cupiditate voluptatem adipisci vitae sequi. Minima dolorem incidunt voluptas et repudiandae tempora ex ut.',3),
                           (4,'nulla','Qui maiores error beatae est qui at. Eum ut laudantium ipsum ex voluptates.\nCum ea distinctio incidunt est delectus ut. Dolorem aliquid sit magnam doloribus est.',4),
                           (5,'animi','Eos eveniet et est natus debitis est. Quo quo voluptatem nihil amet est id sit. Repellat impedit eius repellat reprehenderit tempore quis. Asperiores voluptatem est in eveniet iusto esse.',5),
                           (6,'vero','Eos sunt et laudantium quia. Aliquid et iusto iure rerum repudiandae voluptas qui accusamus. Maxime quia recusandae necessitatibus quisquam est. Officiis qui rerum deserunt laboriosam ipsa non.',1),
                           (7,'sed','Ut atque est ut consequatur id consequatur delectus itaque. Autem non sint sint tempora et et. Sint qui ipsa quos sint.',2),
                           (8,'eum','Sed autem voluptatem quisquam et fuga ea nobis iste. Et officia consequuntur et odit. Iste ad sed tempora veniam suscipit.',3),
                           (9,'dignissimos','Consectetur voluptas cum earum molestiae. Minima et rerum rerum quo quos. Rerum sint sunt laboriosam eum non consequuntur.',4),
                           (10,'doloribus','Sed placeat sapiente et. Incidunt ducimus tempora maiores culpa laborum quia quod. Eum minus voluptas placeat delectus adipisci unde a. Voluptatem illo nesciunt ullam.',5),
                           (11,'reprehenderit','Sed consequatur optio voluptatem. Voluptatem velit pariatur nam repellendus.\nQuod error autem amet harum ipsam a. Ad temporibus natus laudantium. Soluta et officia voluptas numquam architecto.',1),
                           (12,'consectetur','Eaque maiores hic et pariatur quae. Fugit eum eaque assumenda porro. Quis magni veniam et est et dolore dolorem.',2),
                           (13,'possimus','Atque reiciendis deserunt placeat aut sit voluptatem. Sapiente nemo iusto sit sit nihil. Aut ut dolorem dicta et in aut perspiciatis.',3),
                           (14,'quae','Molestiae ea quis et sit consequatur. Ex ipsam voluptate ut nam iusto sequi excepturi. Beatae velit debitis est odio. Ut repellat omnis ut nostrum laboriosam iure aut. Aut eos dolor ipsa excepturi.',4),
                           (15,'ab','Atque voluptatem magni in officiis. Ea expedita ut ad nobis voluptas earum voluptas. Aperiam excepturi autem molestiae unde omnis. Sit suscipit error vitae sed voluptates.',5),
                           (16,'ut','Repellendus dolorum et facilis. Aut qui nobis blanditiis nemo magnam totam dolore.',1),
                           (17,'modi','Est dolores perferendis dolores est minus. Et aut adipisci corporis exercitationem. Quo qui eos aspernatur. Voluptatem est earum asperiores quae numquam qui aut. Id vitae eaque soluta dolores.',2),
                           (18,'ipsum','Provident et assumenda rerum sit blanditiis ut reiciendis. Voluptatibus qui odit non natus. Amet dolor eos adipisci ut et. Ipsum omnis laboriosam quis sunt et sed.',3),
                           (19,'vitae','Provident dolore sed beatae aspernatur et ut quaerat. A consectetur rerum in quia quae sed. Rerum quia dolore atque ab optio voluptatem. Neque et officia quaerat dolorem modi ut consectetur vel.',4),
                           (20,'adipisci','Illo inventore repellendus qui harum fugiat rerum. Nihil dolore iste facere sed possimus voluptates voluptatem. Possimus cupiditate placeat quasi autem voluptatum modi.',5);