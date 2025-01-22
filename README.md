# Azure uAMQP PHP for RedHat Artemis Broker

PHP binding for Azure uAMQP C (AMQP 1.0) - currently being used with RedHat Artemis Broker, but should work for everything with minor modifications else that works with AMQP 1.0. Implemented based on https://github.com/vsouz4/azure-uamqp-php.

This is a wrapper for the C library provided by Azure (Azure uAMQP C), builded as an extension in PHP, providing PHP classes so that PHP code can work with AMQP 1.0.

Currently being used with PHP 7.4. You will need Windows 10/11 and Docker Desktop installed for example launch.

## Startup Instructions
### 1. Launching the AMQP broker (Windows 10)
Download [AMQ Broker 7.11.6](https://access.redhat.com/jbossnetwork/restricted/listSoftware.html?product=jboss.amq.broker) and follow the instructions to launch and test it from the [guide](https://access.redhat.com/documentation/ru-ru/red_hat_amq_broker/7.11/html-single/getting_started_with_amq_broker/index).

### 2. Creating Address and Queue
Using web-console Red Hat Artemis, 
1. Create the address ```MY.TEST.QUEUE.1```.

2. Create a queue ```MY.TEST.QUEUE.1``` for this address.

### 3. Building and running the client (Ubuntu 18.04 in a docker container)
3.1. Clone the project to a convenient location
```git clone https://github.com/Hnakra/azure-uamqp-php.git```

3.2 Navigate to the directory
```cd example azure-uamqp-php```

3.3 Run it by executing the command at the root of the project
```docker-compose -f docker-compose.redhat-os.yml up -d```

3.4 Create a src/parameters.php file based on the src/parameters.php.dist file with your connection parameters to the broker.
```copy src/parameters.php.dist src/parameters.php```

3.5 Access the azure-uamqp-php container using any method convenient for you, for example:
```docker exec -it azure-amq-redhat bash```

3.6 Build the program
```cd /var/www/azure-uamqp-php && make clean && make && make install```

3.6 Navigate to the directory with examples
```cd /var/www/html/example```

3.7 Test it out :)
```php producer.php```
```php consumer.php```
