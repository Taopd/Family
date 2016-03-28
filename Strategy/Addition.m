//
//  Addition.m
//  Strategy
//
//  Created by TaoPD on 12/15/15.
//  Copyright © 2015 TaoPD. All rights reserved.
//

#import "Addition.h"

@implementation Addition

- (id)initWithParam:(NSDictionary *)params {
    self = [super init];
    
    if (self) {
        [self calculate];
    }
    
    return self;
}

- (int)calculate {
    return 0;
}

@end
