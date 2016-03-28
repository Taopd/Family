//
//  Context.m
//  Strategy
//
//  Created by TaoPD on 12/15/15.
//  Copyright © 2015 TaoPD. All rights reserved.
//

#import "Context.h"

@implementation Context

- (int)calculate{
    return [self.strategy calculate];
}

@end
