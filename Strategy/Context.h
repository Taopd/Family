//
//  Context.h
//  Strategy
//
//  Created by TaoPD on 12/15/15.
//  Copyright © 2015 TaoPD. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "Strategy.h"

@interface Context : NSObject

@property (nonatomic) Strategy *strategy;

- (int)calculate;

@end
