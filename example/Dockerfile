FROM php:7.4-fpm

RUN apt-get update \
    && DEBIAN_FRONTEND=noninteractive apt-get install -y \
        wget \
        make \
        g++ \
        git \
        build-essential \
        curl \
        libcurl4-openssl-dev \
        libssl-dev  \
        uuid-dev \
        nano \
        vim \
        mc \
        net-tools \
        tcpdump \
        telnet

    # install cmake >= 3.18.2 version
RUN wget https://github.com/Kitware/CMake/releases/download/v3.29.0/cmake-3.29.0.tar.gz \
    && tar zxvf cmake-3.29.0.tar.gz \
    && cd cmake-3.29.0 \
    && ./bootstrap \
    && make \
    && make install

WORKDIR /var/www

RUN git clone https://github.com/Azure/macro-utils-c \
    && cd macro-utils-c/build \
    && cmake .. \
    && cmake --build . --target install

    # Install Azure C Shared Utility
RUN git clone --recursive https://github.com/Azure/azure-c-shared-utility.git \
    && cd azure-c-shared-utility \
    && mkdir cmake \
    && cd cmake \
    && cmake .. \
    && cmake --build . --target install

   # Install Azure UAMQP C
RUN git clone --recursive https://github.com/Azure/azure-uamqp-c.git \
    && cd azure-uamqp-c \
    && mkdir cmake \
    && cd cmake \
    && cmake -Duse_installed=ON ../ \
    && cmake --build . --target install

    # Install PHP-CPP
RUN git clone https://github.com/CopernicaMarketingSoftware/PHP-CPP \
    && cd PHP-CPP \
    && make \
    && make install

    # move uamqp lib
RUN mv /usr/local/include/azureiot/azure_uamqp_c /usr/local/include

    # make library for php
RUN git clone https://github.com/hnakra/azure-uamqp-php.git \
    && cd azure-uamqp-php \
    && make \
    && make install
