#ifndef UAMQP_PHP_MESSAGE_H
#define UAMQP_PHP_MESSAGE_H
#include <phpcpp.h>
#include "azure_uamqp_c/uamqp.h"

class Message : public Php::Base
{
private:
    std::string body;
    AMQP_VALUE application_properties_map;
    PROPERTIES_HANDLE properties_handle;
    MESSAGE_HANDLE message;
    AMQP_VALUE application_properties;

public:
    Message();
    Message(MESSAGE_HANDLE msg);
    virtual ~Message() = default;
    void setMessageHandler(MESSAGE_HANDLE message);
    MESSAGE_HANDLE getMessageHandler();
    PROPERTIES_HANDLE getPropertiesHandle();
    void setBody(std::string body);
    void __construct(Php::Parameters &params);
    void __destruct();
    Php::Value getBody();
    Php::Value getApplicationProperty(Php::Parameters &params);
    Php::Value getApplicationProperties();
    void setApplicationProperty(Php::Parameters &params);
    Php::Value getMessageAnnotation(Php::Parameters &params);
    void setMessageAnnotation(Php::Parameters &params);
    void setProperty(Php::Parameters &params);
    Php::Value getProperty(Php::Parameters &params);
};

#endif
