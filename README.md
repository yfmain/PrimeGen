# Prime Number Generator

This is a TDD coding practise using php. This project is looking to find the first N prime numbers and display their times tables in command console.

In this exercise, two algorithems have been developed, which are navie method and a modified incremental methoded of the sieve of Eratosthenes. 

For display purpose, there is also a times table generator class developed, which is not efficient, but for the limited amount of data one page can display, this is good enough. 

### Installation 

Clone master branch
Run `composer update` in Project root, to install all dependency packages

### How to use
Run main app:
```
 php Classlib\Primes.php -s size [-n]
```
Run unit tests
```
 phpunit
```
Or if you have not installed PHPUnit, run:
```
 vendor\bin\phpunit
```

### What an output would look like:
pear\Console_Table package is used to covert a times table nicely to output string.

I limited only display the time table of first and last 6 of the total array. There are two reasons for this:
1. Console screen are limited in width to display many columns. My console has default width to 300 characters.
2. The times table function is super unefficient, the time cost of generating a times table of large arrays are much more then find those prime number.

An example of output for the first 500 prime numbers would look like this, with a total of 12 columns maximum.
```
C:\Users\fu\Documents\Development\PrimeNumberGenerator>php Classlib\Primes.php -s 10000
-------------------------------------------------------------------
Prime Times Table - Incremental Sieve of Eratosthenes:
-------------------------------------------------------------------

+--------+--------+--------+--------+--------+---------+---------+-------------+-------------+-------------+-------------+-------------+-------------+
|        |      2 |      3 |      5 |      7 |      11 |      13 |      104701 |      104707 |      104711 |      104717 |      104723 |      104729 |
+--------+--------+--------+--------+--------+---------+---------+-------------+-------------+-------------+-------------+-------------+-------------+
|      2 |      4 |      6 |     10 |     14 |      22 |      26 |      209402 |      209414 |      209422 |      209434 |      209446 |      209458 |
|      3 |      6 |      9 |     15 |     21 |      33 |      39 |      314103 |      314121 |      314133 |      314151 |      314169 |      314187 |
|      5 |     10 |     15 |     25 |     35 |      55 |      65 |      523505 |      523535 |      523555 |      523585 |      523615 |      523645 |
|      7 |     14 |     21 |     35 |     49 |      77 |      91 |      732907 |      732949 |      732977 |      733019 |      733061 |      733103 |
|     11 |     22 |     33 |     55 |     77 |     121 |     143 |     1151711 |     1151777 |     1151821 |     1151887 |     1151953 |     1152019 |
|     13 |     26 |     39 |     65 |     91 |     143 |     169 |     1361113 |     1361191 |     1361243 |     1361321 |     1361399 |     1361477 |
| 104701 | 209402 | 314103 | 523505 | 732907 | 1151711 | 1361113 | 10962299401 | 10962927607 | 10963346411 | 10963974617 | 10964602823 | 10965231029 |
| 104707 | 209414 | 314121 | 523535 | 732949 | 1151777 | 1361191 | 10962927607 | 10963555849 | 10963974677 | 10964602919 | 10965231161 | 10965859403 |
| 104711 | 209422 | 314133 | 523555 | 732977 | 1151821 | 1361243 | 10963346411 | 10963974677 | 10964393521 | 10965021787 | 10965650053 | 10966278319 |
| 104717 | 209434 | 314151 | 523585 | 733019 | 1151887 | 1361321 | 10963974617 | 10964602919 | 10965021787 | 10965650089 | 10966278391 | 10966906693 |
| 104723 | 209446 | 314169 | 523615 | 733061 | 1151953 | 1361399 | 10964602823 | 10965231161 | 10965650053 | 10966278391 | 10966906729 | 10967535067 |
| 104729 | 209458 | 314187 | 523645 | 733103 | 1152019 | 1361477 | 10965231029 | 10965859403 | 10966278319 | 10966906693 | 10967535067 | 10968163441 |
+--------+--------+--------+--------+--------+---------+---------+-------------+-------------+-------------+-------------+-------------+-------------+

Elapsed time: 0.52482295036316 seconds. Memory usage: 868.13 kb.
```

### Development Notes:
Coding Practise

1. This a TDD exercise, aims to have clean code, with SOLID design principle. 
2. I have sepearated dependcy of classes as much as possible, except the mainapp which has logics not belonging there.
3. The coding has considerations to be DRY. The part of code arguable is in the MathLib\NaviePrimes and MathLib\IncrementalSieve (not the best name). They don't use Validators for input, but duplicated the isValid logic inside their own class. I did it this way only because these two classes can have zero dependency to others, so they can be easily copied and reused.
4. Because of the timeing issues, I eventually did something really bay in Service\PrimesTable. I stucked display paging logic there, which is supposed to be a set of separtart classes. PrimesTable is suppose to do only the very one thing (it did not do very well though). Only if the TimesTable fast enough, so the paging can leave this class completely, it can be arguabled acceptable. Otherwise, it is a very bad design (even without the ugly paging code there).
5. The Main app Primes, well, don't consider that is my style. I just stitched a temporary thing there to see the result, which is supposed to be the integration test. There should only be a Di container (I manually DI ed them though) to call PrimesTableConsole service, and print the result. Extra input an argument service, a performance measuring utility, a proper prompt message delivery are needed at the least. 
6. what more to improve, the validation logic is duplicated by the PrimesTableConsole, this is an early design issue.
7. Namings are not good enough, I changed some of them, but rushed to finished all the classes, so some still look really bad.

Primes Finding Algorithms:

1. I TDDed a naive primes finding solution, a very common one. with some improvement though:
  1. I omitted all the even numbers, as the time cost is complete not necessary.
  2. The solution only mod primes found alreay. Good or bad, it reduced cycled by not dividing composistes, but it introduces array search. The might be a banlance, if the array gets really large, it will slowed it down. well, it is a naive solution only. we won't have patient to wait the find a really large prime.
  3. This solution is useful for validing the other methods, as it tell true result.
  4. need to mention we never need to worry about the memory issue, as it does not require much at all.
2. I implemented the incremental version of the sieve of Eratosthenes, and I improved it a little. 
  1. The reason not using traditional sieve of Era was because I need more care to managed memory, it requires a lot. so segamented version is required, and they may all be nice and fast, but I don't have enough time to play with. 
  2. The good thing about incremental one is it clears momory on the go, so it only required the maximum size of required N for the composites array. PHP is not good with memory, so 2G can probably process just over 15M. only guessed, as my pc runs really slow when I attempted to do that. 
  3. The time cost is pretty efficient, ony the best, of course, but it linear, with 5M nubmers, My old laptop ran about 94 secs. do remember, this is PHP engine. 
  4. lots of things can be improved, the method can use bins to manage memory and narrow done the calculation. Primes count function can also help to estimate where the prime is roughly located. Also,  no need to start from begining everytime, use multi text files as bins to store them, to balance the cost of performance on searching a file can compute a "new" but actually known number.
  5. what I did as modification is omitted even numbers like in the naived solution. also I don't use buckets to store every primes as factors for the composite, I rolled it over to find the next unused composite to store. it won't be a great improvenment but I saves time and cycles of accessing buckets. 
  6. I met an array issues in PHP, when its array get indexed with very large integers, it fold back also to a smaller one. e.g. I could not find prime 203897 as there was a $composite[203897] mistakenly created by a $composite[92683 * 92683]. this is a known issue that very large number has probablems on indexing php arrays. so the solution is just casting numbers to string. 

I did not implement big nubmers for those beyond the 64bit can carry. it won't be a issue for the purpose of this exercise. it can be easily done by using BC MATH (php built-in) or GMP extensions. The only thing need to consider that is to banlance the performance by only using this tools when necessary. 


