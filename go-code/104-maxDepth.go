package main

/**
二叉树的最大深度
 * Definition for a binary tree node.
 * type TreeNode struct {
 *     Val int
 *     Left *TreeNode
 *     Right *TreeNode
 * }
*/
// bfs - 广度优先搜索，使用队列，先进先出
func maxDepth(root *TreeNode) int {
	if root == nil {
		return 0
	}
	if root.Left == nil && root.Right == nil {
		return 1
	}
	deep := 0
	var queue [][]*TreeNode
	queue = append(queue, []*TreeNode{root})
	for len(queue) != 0 {
		// 出队列
		tempNodes := queue[0] //取出该层的元素
		queue = queue[1:]     // 将第一个元素进行移除，模拟出队列

		var floorNodes []*TreeNode            // 某一层的元素
		for i := 0; i < len(tempNodes); i++ { // 遍历该层的元素
			if tempNodes[i].Left != nil {
				floorNodes = append(floorNodes, tempNodes[i].Left)
			}
			if tempNodes[i].Right != nil {
				floorNodes = append(floorNodes, tempNodes[i].Right)
			}
		}
		if len(floorNodes) != 0 {
			queue = append(queue, floorNodes)
		}

		deep++ // 层数+1
	}
	return deep
}
