CreditCard
==========

The credit card library allows plausability checking credit cards before submitting them to a payment processor. The best practices at time of writing from writing as determined by stack overflow are used, and the class is designed to be as hassle-free as possible so it can be used in a wide variety of environments.

Usage:

    // Initialize
    $c = new Altruja\CreditCard("4200000000000000");

    // Detect type
    echo $c->type(); // "visa"

    // Verify checksum
    echo $c->valid(); // true

